<?php

namespace App\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\On;

trait WithCrud
{
    #[On('create')]
    public function create(): void
    {
        $this->resetValidation();
        $this->form->setModel($this->initModel());
        $this->showModal = true;
    }

    #[On('edit')]
    public function edit(int $id): void
    {
        $this->resetValidation();
        $this->form->setModel($this->model::find($id));
        $this->showModal = true;
    }

    public function save(): void
    {
        $this->form->save();
        $this->dispatch('notify', ('Saved!'));
        $this->form->setModel($this->initModel());
        $this->showModal = false;
    }

    public function initModel(array $data = null): Model
    {
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
