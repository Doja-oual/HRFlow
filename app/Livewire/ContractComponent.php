<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contract;
use App\Models\User;
use App\Models\ContractType;
use Illuminate\Support\Facades\DB;

class ContractComponent extends Component
{
    use WithPagination;

    public $contract_id, $user_id, $contract_type_id, $start_date, $end_date, $status, $document_path;
    public $isOpen = false, $isDeleteModalOpen = false;
    public $contractTypes, $searchTerm = '';

    protected $rules = [
        'contract_type_id' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required',
    ];
    

    public function mount()
    {
        $this->contractTypes = ContractType::all();
    }

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';

        return view('livewire.contract-component', [
            'contracts' => Contract::with(['user', 'contractType'])
                ->whereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                })
                ->orderBy('start_date', 'desc')
                ->paginate(10),
            'users' => User::all(),
            'contractTypes' => $this->contractTypes,
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
        $this->contract_id = $id;
        $this->isDeleteModalOpen = true;
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
    }

    private function resetFields()
    {
        $this->contract_id = null;
        $this->user_id = '';
        $this->contract_type_id = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->status = 'active';
        $this->document_path = '';
        $this->resetValidation();
    }

    public function store()
    {
        // dd($this->contract_type_id); // Vérifie la valeur avant l'insertion
    
        // $this->validate();
    
        if (!$this->user_id) {
            session()->flash('error', 'Veuillez sélectionner un utilisateur.');
            return;
        }
        DB::transaction(function () {
            Contract::updateOrCreate(
                ['id' => $this->contract_id],
                [
                    'user_id' => $this->user_id, // Vérifier que cette ligne est bien présente
                    'contract_type_id' => $this->contract_type_id,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'status' => $this->status,
                    'document_path' => $this->document_path,
                ]
            );
        });
    
        session()->flash('message', 'Contrat enregistré avec succès !');
        $this->closeModal();
        $this->resetFields();
    }
    
    public function edit($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $this->contract_id = $contract->id;
        $this->user_id = $contract->user_id;
        $this->contract_type_id = $contract->contract_type_id;
        $this->start_date = $contract->start_date;
        $this->end_date = $contract->end_date;
        $this->status = $contract->status;
        $this->document_path = $contract->document_path;
        $this->openModal();
    }

    public function delete()
    {
        DB::transaction(function () {
            Contract::findOrFail($this->contract_id)->delete();
        });

        session()->flash('message', 'Contrat supprimé avec succès !');
        $this->closeDeleteModal();
    }
}
