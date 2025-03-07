<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $userId, $name, $email, $password, $role_id, $employee_id, 
           $position, $department, $hire_date, $status, $phone, 
           $address, $date_of_birth, $gender, $contract_type, 
           $profile_picture, $isOpen = false, $isDeleteModalOpen = false;

    public $searchTerm;

    // Validation des champs
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6', // Le mot de passe est optionnel lors de la mise à jour
            'role_id' => 'required|exists:roles,id',
            'employee_id' => 'nullable|string',
            'position' => 'nullable|string',
            'department' => 'nullable|exists:departments,id', // Assurez-vous que l'ID du département existe
            'hire_date' => 'nullable|date',
            'status' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'contract_type' => 'nullable|string',
            'profile_picture' => $this->profile_picture ? 'image|max:1024' : '', // Validation de l'image
        ];
    }

    // Méthode render pour afficher les utilisateurs
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);
    
        $departments = Department::all();
        $roles = Role::all();  
    
        return view('livewire.user-component', [
            'users' => $users,
            'departments' => $departments, 
            'roles' => $roles  
        ]);
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
        $this->role_id = $user->role_id; 
        $this->employee_id = $user->employee_id;
        $this->position = $user->position;
        $this->department = $user->department_id; // Utiliser l'ID du département
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
        
        $this->validate();
    
        
        if (!Role::find($this->role_id)) {
            session()->flash('error', 'Le rôle sélectionné n\'existe pas.');
            return;
        }
    
        
        $validatedData = [
            'name' => $this->name,
            'email' => $this->email,
            'employee_id' => $this->employee_id,
            'position' => $this->position,
            'department_id' => $this->department,
            'hire_date' => $this->hire_date,
            'status' => $this->status,
            'phone' => $this->phone,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'contract_type' => $this->contract_type,
        ];
    

        if ($this->password) {
            $validatedData['password'] = Hash::make($this->password);
        }
    
        if ($this->profile_picture) {
            $validatedData['profile_picture'] = $this->profile_picture->store('profile-pictures', 'public');
        }
    

        $user = User::updateOrCreate(
            ['id' => $this->userId],
            $validatedData
        );
    
  
        if ($role = Role::find($this->role_id)) {

            $user->roles()->syncWithoutDetaching([$role->id => ['model_type' => User::class]]);
        } else {
            session()->flash('error', 'Le rôle spécifié est invalide.');
            return;
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
        $this->reset([
            'userId', 'name', 'email', 'password', 'role_id', 'employee_id', 
            'position', 'department', 'hire_date', 'status', 'phone', 'address', 
            'date_of_birth', 'gender', 'contract_type', 'profile_picture'
        ]);
    }
}
