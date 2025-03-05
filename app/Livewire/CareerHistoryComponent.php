<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\CareerHistory; // Ensure you import CareerHistory model
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Department;

class CareerHistoryComponent extends Component
{
    use WithPagination;

    public $user_id, $position, $departments, $start_date, $end_date, $description;
    public $editId = null;
    public $employees;

  public function mount()
{
    $this->employees = User::where('role', '=', 'employee')->get();
    $this->departments = Department::all();
    
    
    }

    public function resetFields()
    {
        $this->user_id = '';
        $this->position = '';
        $this->departments = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->description = '';
        $this->editId = null;
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        CareerHistory::create([
            'user_id' => $this->user_id,
            'position' => $this->position,
            'department' => $this->department,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Historique ajouté avec succès.');
        $this->resetFields();
    }

    public function edit($id)
    {
        $history = CareerHistory::findOrFail($id);
        $this->editId = $id;
        $this->user_id = $history->user_id;
        $this->position = $history->position;
        $this->departments = $history->departments;
        $this->start_date = $history->start_date;
        $this->end_date = $history->end_date;
        $this->description = $history->description;
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        CareerHistory::find($this->editId)->update([
            'user_id' => $this->user_id,
            'position' => $this->position,
            'department' => $this->departments,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Historique mis à jour.');
        $this->resetFields();
    }

    public function delete($id)
    {
        CareerHistory::find($id)->delete();
        session()->flash('message', 'Historique supprimé.');
    }

    public function render()
    {
        $careerHistories = CareerHistory::paginate(10); 

        return view('livewire.career-history-component', compact('careerHistories')); }
}
