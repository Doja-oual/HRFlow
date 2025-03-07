<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionComponent extends Component
{
    use WithPagination;

    public $permissionId, $name;
    public $isOpen = false, $isDeleteModalOpen = false;

    protected $rules = [
        'name' => 'required|string|unique:permissions,name',
    ];

    public function render()
    {
        return view('livewire.permission-component', [
            'permissions' => Permission::paginate(10),
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

        Permission::create(['name' => $this->name]);

        session()->flash('message', 'Permission ajoutée avec succès !');
        $this->closeModal();
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate();

        $permission = Permission::findOrFail($this->permissionId);
        $permission->update(['name' => $this->name]);

        session()->flash('message', 'Permission mise à jour avec succès !');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->permissionId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function delete()
    {
        Permission::findOrFail($this->permissionId)->delete();
        session()->flash('message', 'Permission supprimée avec succès !');
        $this->isDeleteModalOpen = false;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset(['permissionId', 'name']);
    }
}
