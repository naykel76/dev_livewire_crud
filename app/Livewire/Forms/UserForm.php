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

    /**
     * Set the current User model instance for the form and initialize the
     * values from the model instance.
     *
     * @param User $user The User model instance to be set
     * @return void
     */
    public function setModel(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    /**
     * Retrieves the current User model instance from the form object
     *
     * @return User The current User model instance
     */
    public function getModel(): User
    {
        return $this->user;
    }
}
