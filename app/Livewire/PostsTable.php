<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostsTable extends Component
{
    public function delete($id)
    {
        $post = Post::find($id);

        // NK::TD Authorization...

        $post->delete();
    }

    public function render()
    {
        return view('livewire.posts-table', [
            'posts' => Post::all()
        ]);
    }
}
