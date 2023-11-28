<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use App\Livewire\Forms\PostForm;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Post;

class PostCreateEdit extends Component
{
    public PostForm $form;
    protected array $initialData = [];
    public bool $showModal = false;

    #[On('add')]
    public function add()
    {
        $this->resetValidation();
        $this->setBlankModel();
        $this->showModal = true;
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->resetValidation();
        $this->form->setPost(Post::find($id));
        $this->showModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->dispatch('notify', ('Saved!'));
        $this->setBlankModel();
        $this->showModal = false;
    }

    public function setBlankModel()
    {
        $initialised = $this->initModel($this->initialData);
        $this->form->setPost($initialised);
    }

    public function initModel(array $data = []): Model
    {
        // initialize the model with the given data
        $model = Post::make($data);

        // Get all column names for the posts table
        $columns = Schema::getColumnListing($model->getTable());

        // Set all columns to their current value if it exists, otherwise set
        // them to empty strings.
        foreach ($columns as $column) {
            $model->$column = $model->$column ?? '';
        }

        return $model;
    }
}
