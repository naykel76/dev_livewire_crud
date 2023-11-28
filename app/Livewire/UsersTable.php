<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UsersTable extends Component
{
    public function delete($id)
    {
        $user = User::find($id);

        // NK::TD Authorization...

        $user->delete();
    }

    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::all()
        ]);
    }
}
