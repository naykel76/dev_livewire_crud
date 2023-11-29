<?php

namespace App\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\On;

trait WithCrud
{
    /**
     * Set up the form object with a model instance, initialized either with
     * the provided data or with empty strings for each column, and then
     * display a modal.
     *
     * Listens for the 'create' event from a parent component.
     *
     * @return void
     */
    #[On('create')]
    public function create(): void
    {
        $this->form->setModel($this->initModel());
        $this->showModal = true;
    }

    /**
     * Find the model instance with the given id and set it to the form
     * object, then display a modal.
     *
     * Listens for the 'edit' event from a parent component.
     *
     * @param int $id The id of the model instance to be edited
     * @return void
     */
    #[On('edit')]
    public function edit(int $id): void
    {
        $this->resetErrorBag(); // clear any previous error messages
        $this->form->setModel($this->model::findOrFail($id));
        $this->showModal = true;
    }

    /**
     * The save method is a hybrid method used to either create a new record
     * or update an existing one. It first validates the form data and
     * retrieves the model from the form.
     *
     * If the model exists, it calls the update method; otherwise, it calls
     * the store method. After the record is saved, it dispatches a
     * notification, resets the form with a new model instance, and hides the
     * modal.
     *
     * @return void
     */
    public function save(): void
    {
        $validated = $this->form->validate();
        $model = $this->form->getModel();

        // If the model exists, call the update method; otherwise, call the store method
        $model->exists
            ? $this->update($model, $validated)
            : $this->store($model, $validated);

        $this->dispatch('notify', ('Saved!'));

        // reset the form with a new model instance
        $this->form->setModel($this->initModel());
        $this->showModal = false;
    }

    /**
     * Create a new record in the database.
     *
     * @param Model $model The model instance
     * @param array $validated The validated data to be stored
     * @return void
     */
    public function store(Model $model, array $validated): void
    {
        $model::create($validated);
    }

    /**
     * Update an existing record in the database.
     *
     * @param Model $model The model instance
     * @param array $validated The validated data to be updated
     * @return void
     */
    public function update(Model $model, array $validated): void
    {
        $model->update($validated);
    }

    public function initModel(array $data = null): Model
    {
        // clear any previous error messages
        $this->resetErrorBag();

        // Create a new instance of the model with the provided data or with
        // initial data if no data is provided
        $model = $this->model::make($data ?? $this->initialData);

        // Get all column names for the model's table
        $columns = Schema::getColumnListing($model->getTable());

        // For each column, set its value to the provided data if it exists,
        // otherwise set it to an empty string
        foreach ($columns as $column) {
            $model->$column = $model->$column ?? '';
        }

        return $model;
    }
}
