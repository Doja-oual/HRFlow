<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $userId, $name, $email, $password, $role, $employee_id, 
           $position, $department, $hire_date, $status, $phone, 
           $address, $date_of_birth, $gender, $contract_type, 
           $profile_picture, $isOpen = false, $isDeleteModalOpen = false;

    public $searchTerm;

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);

        return view('livewire.user-component', compact('users'));
    }

    public function create()
    {
        $this->resetInput();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->employee_id = $user->employee_id;
        $this->position = $user->position;
        $this->department = $user->department;
        $this->hire_date = $user->hire_date;
        $this->status = $user->status;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->date_of_birth = $user->date_of_birth;
        $this->gender = $user->gender;
        $this->contract_type = $user->contract_type;
        $this->isOpen = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->userId ? 'nullable|min:6' : 'required|min:6',
            'role' => 'required|string',
            'employee_id' => 'nullable|string',
            'position' => 'nullable|string',
            'department' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'status' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'contract_type' => 'nullable|string',
            'profile_picture' => $this->profile_picture ? 'image|max:1024' : '',
        ]);

        if ($this->profile_picture) {
            $validatedData['profile_picture'] = $this->profile_picture->store('profile-pictures', 'public');
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($validatedData);
        } else {
            $validatedData['password'] = Hash::make($this->password);
            User::create($validatedData);
        }

        session()->flash('message', $this->userId ? 'Utilisateur mis à jour!' : 'Utilisateur créé!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->userId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        User::findOrFail($this->userId)->delete();
        session()->flash('message', 'Utilisateur supprimé!');
        $this->isDeleteModalOpen = false;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'role', 'employee_id', 'position', 'department', 'hire_date', 'status', 'phone', 'address', 'date_of_birth', 'gender', 'contract_type', 'profile_picture']);
    }
}
