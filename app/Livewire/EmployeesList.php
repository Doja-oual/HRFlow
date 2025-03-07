<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class EmployeesList extends Component
{
    use WithPagination;
    
    public $search = '';
    public $departmentFilter = '';
    public $roleFilter = '';
    public $departments = [];
    public $roles = [];
    public $showCursusModal = false;
    public $selectedEmployee = null;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'roleFilter' => ['except' => ''],
    ];
    
    public function mount()
    {
        $this->departments = \App\Models\Department::pluck('name', 'id')->toArray();
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function viewCursus($employeeId)
    {
        $this->selectedEmployee = User::with(['careerRecords', 'leaveRequests', 'salaryPromotions'])->findOrFail($employeeId);
        $this->showCursusModal = true;
    }
    
    public function closeCursusModal()
    {
        $this->showCursusModal = false;
        $this->selectedEmployee = null;
    }
    
    public function render()
    {
        $employees = User::role('employee')
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('employee_id', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->departmentFilter, function ($query) {
                return $query->where('department_id', $this->departmentFilter);
            })
            ->when($this->roleFilter, function ($query) {
                return $query->role($this->roleFilter);
            })
            ->orderBy('name')
            ->paginate(10);
            
        return view('livewire.employees-list', [
            'employees' => $employees
        ]);
    }
}
