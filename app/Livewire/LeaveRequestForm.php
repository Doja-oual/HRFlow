<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveRequestForm extends Component
{
    public $start_date;
    public $end_date;
    public $days_requested;
    public $status = 'pending';
    public $employee_name;

    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
    ];

    public function mount()
    {
        if (Auth::check()) { $this->employee_name = Auth::user()->name;
             } else {
                 
                  session()->flash('error', 'Vous devez être connecté pour faire une demande de congé.');
                 } }

    public function calculateDaysRequested()
    {
        if ($this->start_date && $this->end_date) {
            $this->days_requested = Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date)) + 1;
        }
    }

    public function submit()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Vous devez être connecté pour soumettre une demande de congé.');
            return;
        }

        $this->validate();

        LeaveRequest::create([
            'employee_id' => Auth::id(), 
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days_requested' => $this->days_requested,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Demande de congé soumise avec succès.');

        $this->reset(['start_date', 'end_date', 'days_requested']);
    }

    public function render()
    {
        return view('livewire.leave-request-form');
    }
}
