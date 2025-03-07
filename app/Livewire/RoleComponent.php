<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleComponent extends Component
{
    use WithPagination;

    public $roleId, $name, $permissions = [];
    public $allPermissions = [];
    public $selectedPermissions = [];
    public $isOpen = false, $isDeleteModalOpen = false;

    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name',
            'selectedPermissions' => 'array',  
            'selectedPermissions.*' => 'exists:permissions,id', 
        ];
    }

    public function mount()
    {
        $this->allPermissions = Permission::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.role-component', [
            'permissions' => Permission::all(),
            'roles' => Role::with('permissions')->paginate(10), 
        ]);
    }

    public function create()
    {
        $this->resetInput();
        $this->isOpen = true;
    }

    public function store()
{
    $this->validate();

    // 🔥 Création du rôle via Spatie
    $role = Role::create(['name' => $this->name]);

    // 🔥 Correction : Récupérer les noms des permissions avant l'attachement
    $permissionNames = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();

    // 🔥 Associer les permissions au rôle
    $role->givePermissionTo($permissionNames);

    session()->flash('message', 'Rôle créé avec succès !');
    
    $this->reset(['name', 'selectedPermissions']); 
}

    


    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('id')->toArray(); // Récupérer les IDs des permissions
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate();
    
        $role = Role::findOrFail($this->roleId);
        $role->update(['name' => $this->name]);
    
        // 🔥 Correction : Récupérer les noms des permissions
        $permissionNames = Permission::whereIn('id', $this->permissions)->pluck('name')->toArray();
    
        // 🔥 Mise à jour des permissions
        $role->syncPermissions($permissionNames);
    
        session()->flash('message', 'Rôle mis à jour avec succès !');
        $this->closeModal();
    }
    

    public function confirmDelete($id)
    {
        $this->roleId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        Role::findOrFail($this->roleId)->delete();
        session()->flash('message', 'Rôle supprimé avec succès!');
        $this->isDeleteModalOpen = false;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset(['roleId', 'name', 'permissions']);
    }
}
