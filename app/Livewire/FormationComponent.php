<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FormationComponent extends Component
{
    use WithPagination, WithFileUploads;

    public $formation_id, $user_id, $title, $description, $institution, $start_date, $end_date, $status, $certificate;
    public $isOpen = false, $isDeleteModalOpen = false, $editing = false;
    public $searchTerm = '';
    public $users;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'institution' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required|in:completed,ongoing,planned',
        'certificate' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    ];

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.formation-component', [
            'trainings' => Formation::with('employee')->paginate(5),
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function openDeleteModal($id)
    {
        $this->formation_id = $id;
        $this->isDeleteModalOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
    }

    private function resetFields()
    {
        $this->formation_id = null;
        $this->user_id = '';
        $this->title = '';
        $this->description = '';
        $this->institution = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->status = 'ongoing';
        $this->certificate = '';
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

    

        DB::transaction(function () {
            Formation::updateOrCreate(
                ['id' => $this->formation_id],
                [
                    'user_id' => $this->user_id,
                    'title' => $this->title,
                    'description' => $this->description,
                    'institution' => $this->institution,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'status' => $this->status,
                    'certificate' => $this->certificate,
                ]
            );
        });

        session()->flash('message', 'Formation enregistrée avec succès !');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($formationId)
    {
        $formation = Formation::findOrFail($formationId);
        $this->formation_id = $formation->id;
        $this->user_id = $formation->user_id;
        $this->title = $formation->title;
        $this->description = $formation->description;
        $this->institution = $formation->institution;
        $this->start_date = $formation->start_date;
        $this->end_date = $formation->end_date;
        $this->status = $formation->status;
        $this->certificate = $formation->certificate;
        $this->openModal();
    }

    public function delete()
    {
        DB::transaction(function () {
            Formation::findOrFail($this->formation_id)->delete();
        });

        session()->flash('message', 'Formation supprimée avec succès !');
        $this->closeDeleteModal();
    }
}
