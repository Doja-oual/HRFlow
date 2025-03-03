<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SalaryPromotion;
use App\Models\User;
use Carbon\Carbon;

class SalaryPromotionComponent extends Component
{

    public $user;
    public $new_salary;
    public $new_job_title;
    public $comment;
    public $date_of_change;

    protected $rules =[
      'new_salary' => 'required|numeric|min:0',
      'new_job_title'=>'required|string|max:255',
      'comment'=>'nullable|string|max:500',
      'date_of_change'=> 'required|date',  
    ];

    public function mount(User $user){
        $this->user=$user;
    }

    public function savePromotion(){
        $this->validate();

        SalaryPromotion::create([
            'user_id' => $this->user->id,
            'new_salary' => $this->new_salary,
            'new_job_title' => $this->new_job_title,
            'comment' => $this->comment,
            'date_of_change' => Carbon::parse($this->date_of_change),
        ]);

        $this->user->update([
            'salary' => $this->new_salary,
            'job_title' => $this->new_job_title,
        ]);
        $this->reset(['new_salary', 'new_job_title', 'comment', 'date_of_change']);
        session()->flash('success', 'Promotion ajoutée avec succès !');

        $this->dispatch('promotionAdded');

    }
    public function render()
    {
        return view('livewire.salary-promotion-component',[
            'promotions' => $this->user->salaryPromotions()->latest()->get(),

        ]);
    }

}
