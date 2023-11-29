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

    public function setModel(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
    }

    public function save()
    {
        $validated = $this->validate();
        // if there is a post id, update the post, otherwise create a new one
        $this->post->exists ? $this->update($validated) : $this->create($validated);
    }

    public function create($validated)
    {
        Post::create($validated);
    }

    public function update($validated)
    {
        $this->post->update($validated);
    }
}
