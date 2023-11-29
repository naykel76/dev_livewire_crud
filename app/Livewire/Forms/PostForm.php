<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use App\Models\Post;
use Livewire\Form;

class PostForm extends Form
{
    public Post $post;

    #[Validate('required|max:100')]
    public string $title;
    #[Validate('required')]
    public string $description;

    /**
     * Set the current Post model instance for the form and initialize the
     * values from the model instance.
     *
     * @param Post $post The Post model instance to be set
     * @return void
     */
    public function setModel(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
    }

    /**
     * Retrieves the current Post model instance from the form object
     *
     * @return Post The current Post model instance
     */
    public function getModel(): Post
    {
        return $this->post;
    }
}
