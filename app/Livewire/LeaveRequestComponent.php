<?php
namespace App\Livewire;

use App\Models\LeaveRequest;
use Livewire\Component;
use Carbon\Carbon;

class LeaveRequestComponent extends Component
{
    public $employee; 
    public $leaveRequest; 
    public $start_date;
    public $end_date;
    public $days_requested;

    public function mount($leaveRequestId)
    {
       
        $this->leaveRequest = LeaveRequest::findOrFail($leaveRequestId);
        $this->employee = $this->leaveRequest->employee;

        
        $this->start_date = $this->leaveRequest->start_date->format('Y-m-d');
        $this->end_date = $this->leaveRequest->end_date->format('Y-m-d');
    }

   
    public function calculateLeaveDays()
    {
        $this->days_requested = $this->leaveRequest->calculateDaysRequested();

       
        $this->leaveRequest->update(['days_requested' => $this->days_requested]);

        
        session()->flash('message', "Jours de conge demandes : {$this->days_requested}");
    }

    
    public function calculateLeaveBalance()
    {
        $leaveBalance = $this->employee->calculateLeaveDays();
        session()->flash('message', "Solde de congés pour l'employé : {$leaveBalance} jours");
    }

    public function render()
    {
        return view('livewire.leave-request-component');
    }
}
