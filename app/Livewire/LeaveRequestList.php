<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LeaveRequest;

class LeaveRequestList extends Component
{
    public $leaveRequests;

    public function mount()
    {
        $this->leaveRequests = LeaveRequest::with('user')->get(); 
    }

    public function render()
    {
        return view('livewire.leave-request-list');
    }
}
