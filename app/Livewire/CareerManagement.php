<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Department;
use App\Models\ContractType;
use App\Models\CareerRecord;
use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CareerManagement extends Component
{
    public $user;
    public $userId;
    public $departmentName;
    public $contractTypeName;
    public $careerRecords;
    public $lastCareerRecord;
    public $formations;
    public $contractTypes;

    public $isEditModalOpen = false;
    public $editCareerRecord = [
        'type' => '',
        'notes' => '',
        'end_date' => '',
        'status' => '',
        'salary' => '',
        'formation_id' => '',
        'contract_type_id' => ''
    ];

    public function mount($userId)
    {
        // if (!Auth::user()->can('manage-users')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $this->userId = $userId;
        $this->loadUserData();
        $this->loadDropdownOptions();
    }

    protected function loadUserData()
    {
        $this->user = User::findOrFail($this->userId);
        $this->departmentName = $this->user->department->name ?? 'Not Assigned';
        $this->contractTypeName = $this->user->contractType->name ?? 'Not Assigned';
        $this->careerRecords = $this->user->careerRecords()->orderBy('created_at', 'asc')->get();
        $this->lastCareerRecord = $this->careerRecords->last();
    }

    protected function loadDropdownOptions()
    {
        $this->formations = Formation::all();
        $this->contractTypes = ContractType::all();
    }

    public function openEditModal()
    {
        $this->isEditModalOpen = true;
        
        if ($this->lastCareerRecord) {
            $this->editCareerRecord = [
                'type' => $this->lastCareerRecord->type ?? '',
                'notes' => $this->lastCareerRecord->notes ?? '',
                'end_date' => $this->lastCareerRecord->end_date ?? null,
                'status' => $this->lastCareerRecord->status ?? '',
                'salary' => $this->lastCareerRecord->salary ?? '',
                'formation_id' => $this->lastCareerRecord->formation_id ?? null,
                'contract_type_id' => $this->lastCareerRecord->contract_type_id ?? null
            ];
        }
        
        $this->dispatch('open-modal');
    }

    public function closeEditModal()
    {
        $this->isEditModalOpen = false;
        $this->resetValidation();
    }

    public function updateCareerRecord()
    {
        $validatedData = $this->validate([
            'editCareerRecord.type' => 'required|string|max:255',
            'editCareerRecord.notes' => 'nullable|string',
            'editCareerRecord.end_date' => 'nullable|date',
            'editCareerRecord.status' => 'required|string|max:255',
            'editCareerRecord.salary' => 'nullable|numeric',
            'editCareerRecord.formation_id' => 'nullable|exists:formations,id',
            'editCareerRecord.contract_type_id' => 'nullable|exists:contract_types,id'
        ]);
    
        DB::beginTransaction();
    
        try {
            $careerRecord = new CareerRecord();
            $careerRecord->user_id = $this->userId;
            $careerRecord->type = $this->editCareerRecord['type'];
            $careerRecord->notes = $this->editCareerRecord['notes'];
            $careerRecord->end_date = $this->editCareerRecord['end_date'];
            $careerRecord->status = $this->editCareerRecord['status'];
            $careerRecord->salary = $this->editCareerRecord['salary'];
            $careerRecord->formation_id = $this->editCareerRecord['formation_id'];
            $careerRecord->contract_type_id = $this->editCareerRecord['contract_type_id'];
            $careerRecord->save();
    
            if ($this->editCareerRecord['salary'] !== null) {
                $this->user->salary = $this->editCareerRecord['salary'];
                $this->user->save();
            }
    
            if ($this->editCareerRecord['contract_type_id'] !== null) {
                $this->user->contract_type = $this->editCareerRecord['contract_type_id'];
                $this->user->save();
            }
            
            DB::commit();
    
            $this->loadUserData();
            $this->closeEditModal();
    
            session()->flash('message', 'Career record updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update career record. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.career-management');
    }
}
