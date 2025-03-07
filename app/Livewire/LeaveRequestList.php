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

    public function updateStatus($id)
    {
        $leaveRequest = LeaveRequest::find($id);

        if ($leaveRequest) {
            if ($leaveRequest->status == 'approved') {
                $leaveRequest->status = 'rejected';
            } elseif ($leaveRequest->status == 'rejected') {
                $leaveRequest->status = 'approved';
            } else {
                $leaveRequest->status = 'approved';
            }

            $leaveRequest->save();
            session()->flash('message', 'Le statut de la demande de congé a été mis à jour.');
        }
    }

    public function render()
    {
        return view('livewire.leave-request-list');
    }
}
