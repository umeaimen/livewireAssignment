<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    public bool $isUpdate = false;
    public $id;

    public ?string $name;
    public ?string $email;
    public ?string $password;
    public ?string $role ;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'role' => ['required', 'string'],
        ];
    }

    public function set(User $user): void
    {
        $this->name = $user?->name;
        $this->email = $user?->email;
        $this->password = $user?->password;
        $this->role= $user?->role_id;
    }
}
