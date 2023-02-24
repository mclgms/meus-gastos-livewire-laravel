<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class PlanList extends Component
{
    protected $listeners = [
        'closeModal'
    ];
    public $showModal = false;

    public function openModal($planId)
    {
        $this->emit('openModal',$planId);
        $this->showModal = true;
    }

    public function closeModal($message)
    {
        if ($message) {
            session()->flash('message','Feature adicionada com sucesso');
        }
        $this->showModal = false;
    }


    public function render()
    {
        $plans = Plan::all();
        return view('livewire.plan.plan-list',
            compact('plans'));
    }
}
