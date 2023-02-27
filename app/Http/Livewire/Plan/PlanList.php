<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PlanList extends Component
{
    use AuthorizesRequests;

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
        $this->authorize('check.user.is.admin');

        $plans = Plan::all();
        return view('livewire.plan.plan-list',
            compact('plans'));
    }
}
