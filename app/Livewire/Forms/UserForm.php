<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{

    public User $user;

    public string $name;
    #[Validate]
    public string $email;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id
        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $validated = $this->validate();
        // if there is a user id, update the user, otherwise create a new one
        $this->user->exists ? $this->update($validated) : $this->create($validated);

    }

    public function create($validated)
    {
        User::create($validated);
    }

    public function update($validated)
    {
        $this->user->update($validated);
    }
}
