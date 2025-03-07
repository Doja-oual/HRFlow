<?php

namespace App\Livewire;

use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class CongeForm extends Component
{
    public $type = 'Congé annuel';
    public $start_date;
    public $end_date;
    public $total_days = 0;
    public $reason;
 

    protected $rules = [
        'type' => 'required|in:Congé annuel,Récupération',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'reason' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->start_date = Carbon::now()->addDays(7)->format('Y-m-d');
        $this->end_date = Carbon::now()->addDays(8)->format('Y-m-d');
        $this->calculateDays();
    
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if (in_array($propertyName, ['start_date', 'end_date'])) {
            $this->calculateDays();
        }
    }

    public function calculateDays()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);
            $this->total_days = $start->diffInDaysFiltered(function (Carbon $date) {
                return !$date->isWeekend();
            }, $end) + 1;
        }
    }

    public function submit()
    {
        $this->validate();

        $user = Auth::user();
        $leaveBalance = $user->getOrUpdateLeaveBalance();
       

        // Vérifie du solde
        if ($this->type === 'Congé annuel' && $leaveBalance->annual_balance < $this->total_days) {
            session()->flash('error', 'Solde de congé annuel insuffisant. Vous avez ' . $leaveBalance->annual_balance . ' jours disponibles.');
            return;
        }

        if ($this->type === 'Récupération' && $leaveBalance->recovery_balance < $this->total_days) {
            session()->flash('error', 'Solde de récupération insuffisant. Vous avez ' . $leaveBalance->recovery_balance . ' jours disponibles.');
            return;
        }

        //  7 jours pour les conges annuels
        if ($this->type === 'Congé annuel') {
            $oneWeekFromNow = Carbon::now()->addDays(7);
            $requestStart = Carbon::parse($this->start_date);
            if ($requestStart->lessThan($oneWeekFromNow)) {
                session()->flash('error', 'Les congés annuels doivent être demandés au moins une semaine à l’avance.');
                return;
            }
        }

        LeaveRequest::create([
            'employee_id' => $user->id,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'days_requested' => $this->total_days,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Demande de congé soumise avec succès.');
        $this->reset(['type', 'reason']);
        $this->mount();
        $this->dispatch('congeRequested');
    }

    public function render()
    {
        $user = Auth::user();
        $leaveBalance = $user->getOrUpdateLeaveBalance();
        return view('livewire.conge-form', [
            'annualBalance' => $leaveBalance->annual_balance,
            'recoveryBalance' => $leaveBalance->recovery_balance,
        ]);
    }
}