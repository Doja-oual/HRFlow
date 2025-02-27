<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Importez le trait
use App\Http\Requests\UserRequest;
use App\Models\User;

class CreateUser extends Component
{
    use WithFileUploads; // Ajoutez ceci

    public $name, $email, $password, $role, $employee_id, $position, 
           $department, $hire_date, $status, $phone, $address, 
           $date_of_birth, $gender, $contract_type, $profile_picture;

    public function createUser(UserRequest $request)
    {
        $validated = $request->validated();

        // Gestion du téléchargement de la photo de profil
        if ($this->profile_picture) {
            $path = $this->profile_picture->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'employee_id' => $validated['employee_id'],
            'position' => $validated['position'],
            'department' => $validated['department'],
            'hire_date' => $validated['hire_date'],
            'status' => $validated['status'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'contract_type' => $validated['contract_type'],
            'profile_picture' => $validated['profile_picture'] ?? null,
        ]);
// $user->syncRoles($request->roles)
        session()->flash('message', 'Utilisateur créé avec succès!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-user');
            
    }
}