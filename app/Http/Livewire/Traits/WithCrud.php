<?php

namespace App\Http\Livewire\Traits;

trait WithCrud
{

    public function mountWithCrud()
    {
        $this->editing = self::$model::find(1);
        // $this->editing = $this->makeBlankModel();
    }

    /**
     * Create blank model or set current $editing model.
     *
     * if $editing has primary key, there is record from the
     * database in the current form so don't reset fields.
     */
    public function create(): void
    {
        if ($this->editing->getKey()) $this->editing = $this->makeBlankModel();

        $this->showModal = true;
    }

    /**
     * Edit the current or new model
     */
    public function edit($id): void
    {
        // if the current $editing model is not equal to the
        // $selected model passed in then override it, otherwise
        // leave it alone. isNot() helper compares two models

        $selected = self::$model::find($id);

        if ($this->editing->isNot($selected)) $this->editing = $selected;

        $this->showModal = true;
    }



    public function save(): void
    {
        $this->validate();
        $this->editing->forceFill([])->save();
        // NK::TD this will eventually fail!
        $this->mainImage ? $this->handleMainImage($this->mainImage) : null;
        $this->showModal = false;

        $this->dispatchBrowserEvent('notify', 'Saved!');
    }

    public function delete($id): void
    {
        $project = self::$model::find($id);
        $project->delete();
    }

    /**
     * Create instance of the model but do not persist to the
     * database to set default values and avoid errors.
     */
    public function makeBlankModel()
    {
        return self::$model::make($this->initialData);
    }
}
