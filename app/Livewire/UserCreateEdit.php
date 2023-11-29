<?php

namespace App\Livewire;

use App\Livewire\Traits\WithCrud;
use App\Livewire\Forms\UserForm;
use Livewire\Component;
use App\Models\User;

class UserCreateEdit extends Component
{
    use WithCrud;

    protected array $initialData = [];
    public bool $showModal = false;
    private $model = User::class;
    public UserForm $form;
}
