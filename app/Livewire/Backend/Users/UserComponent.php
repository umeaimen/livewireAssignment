<?php

namespace App\Livewire\Backend\Users;

use Livewire\Component;
use App\Traits\WithMainModal;
use App\Livewire\Forms\UserForm;
use Livewire\Attributes\On;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserComponent extends Component
{
    use WithMainModal;
    protected $debug = true;
    public string $search = '';
    public string $columnName = 'created_at';
    public string $sortDirection = 'desc';
    public int $limitPerPage = 10;
    public $modalTitle;
    public UserForm $form;

    private function getUsers(): LengthAwarePaginator
    {
        $this->search ? $this->resetPage() : ''; // reset pagination while searching
        // getList($this->search, $this->columnName, $this->sortDirection)
        return User::paginate($this->limitPerPage);
    }
    public function render()
    {
        $this->modalTitle = $this->form->isUpdate ? 'Update' : 'Add';
        $users = $this->getUsers();
        $roles = Role::all();
        return view('livewire.backend.users.user-component' , compact('roles', 'users'));
    }
    public function store(){
        $validated = $this->form->validate() ;
        try {
            DB::beginTransaction();
            $password = Hash::make($validated['password']);
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $password
            ]);
             $user->roles()->attach($validated['role']);
            DB::commit();
            $this->closeMainModal();
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Contract Created Successfully!']);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::rollBack();
            $this->dispatch('alert', ['type' => 'error',  'message' => $exception->getMessage()]);
        }
    }
    public function edit($id)
    {
        $this->form->isUpdate = true;
        $this->form->id = $id;
        try {
            $user = User::findOrFail($id);
            $this->form->set($user);
            $this->openMainModal();
        } catch (\Exception $exception) {
            $this->dispatch('alert', ['type' => 'error',  'message' => $exception->getMessage()]);
        }
    }

    public function update($id)
    {
        $this->form->validate();
        $user = User::with('roles')->findOrFail($id);
        try {
            DB::beginTransaction();
            $user->update([
                'name' => $this->form->name,
                'email' => $this->form->email,
            ]);
            $user->roles()->sync($this->form->role);
            DB::commit();

            $this->closeMainModal();
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Contract Updated Successfully!']);
        } catch (\Exception $exception) {
            $this->dispatch('alert', ['type' => 'error',  'message' => $exception->getMessage()]);
        }
    }

    public function deleteConfirmation($id)
    {
        $this->dispatch('swal-alert', [
            'id' => $id,
            'type' => 'delete',
            'iconType' => 'warning',
            'title' => 'Are you sure?',
            'description' => 'You are about to delete the client. This action cannot be undone.',
        ]);
    }
    #[On('delete')]
    public function destroy($id)
    {
        try {
            if(auth()->user()->id == $id){
              return  $this->dispatch('alert', ['type' => 'warning',  'message' => 'You are not allowed for this action!']);
            }
            $contract = User::findOrFail($id);
            $contract->delete();
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Contract Deleted Successfully!']);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            $this->dispatch('alert', ['type' => 'error',  'message' => $exception->getMessage()]);
        }
    }
}
