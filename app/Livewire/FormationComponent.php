<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Formation;
class FormationComponent extends Component
{
    
    use WithPagination;

    public $title, $description, $institution, $start_date, $end_date, $status, $certificate;
    public $editing = false, $trainingId;
    
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'institution' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required|in:completed,ongoing,planned',
        'certificate' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    ];

    public function render()
    {
        return view('livewire.formation-component', [
            'trainings' => Formation::query()->paginate(5),
        ]);
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'institution', 'start_date', 'end_date', 'status', 'certificate', 'editing', 'trainingId']);
    }

    public function store()
    {
        $this->validate();
        
        $training = Formation::create([
             'employee_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'institution' => $this->institution,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        if ($this->certificate) {
            $training->addMedia($this->certificate->getRealPath())->toMediaCollection('certificates');
        }

        session()->flash('message', 'Formation ajoutée avec succès.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $training = Formation::findOrFail($id);
        $this->trainingId = $training->id;
        $this->title = $training->title;
        $this->description = $training->description;
        $this->institution = $training->institution;
        $this->start_date = $training->start_date;
        $this->end_date = $training->end_date;
        $this->status = $training->status;
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();
        
        $training = Formation::findOrFail($this->trainingId);
        $training->update([
            'title' => $this->title,
            'description' => $this->description,
            'institution' => $this->institution,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        if ($this->certificate) {
            $training->clearMediaCollection('certificates');
            $training->addMedia($this->certificate->getRealPath())->toMediaCollection('certificates');
        }

        session()->flash('message', 'Formation mise à jour.');
        $this->resetForm();
    }

    public function delete($id)
    {
        $training = Formation::findOrFail($id);
        $training->delete();
        session()->flash('message', 'Formation supprimée.');
    }

}
