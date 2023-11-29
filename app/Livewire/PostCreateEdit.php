<?php

namespace App\Livewire;


use App\Livewire\Traits\WithCrud;
use App\Livewire\Forms\PostForm;
use Livewire\Component;
use App\Models\Post;

class PostCreateEdit extends Component
{
    use WithCrud;

    protected array $initialData = [];
    public bool $showModal = false;
    private $model = Post::class;
    public PostForm $form;
}
