<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Livewire\Forms\UserForm;
use Livewire\Component;
use App\Models\User;

class UsersTable extends Component
{
    public UserForm $form;
    protected array $initialData = [];

    public function mount()
    {
        $this->setBlankModel();
    }

    public function setBlankModel()
    {
        $initialised = $this->initModel($this->initialData);
        $this->form->setUser($initialised);
    }

    public function initModel(array $data = []): Model
    {
        // initialize the model with the given data
        $model = User::make($data);

        // Get all column names for the users table
        $columns = Schema::getColumnListing($model->getTable());

        // Set all columns to their current value if it exists, otherwise set
        // them to empty strings.
        foreach ($columns as $column) {
            $model->$column = $model->$column ?? '';
        }

        return $model;
    }

    public function add()
    {
        $this->setBlankModel();
    }

    public function edit($id)
    {
        $this->form->setUser(User::find($id));
    }

    public function save()
    {
        $this->form->save();
        $this->dispatch('notify', ('Saved!'));
        $this->setBlankModel();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::all()
        ]);
    }
}
