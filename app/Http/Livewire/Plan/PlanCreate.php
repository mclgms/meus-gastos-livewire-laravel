<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use App\Services\PagSeguro\Plan\PlanCreateService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PlanCreate extends Component
{
    use AuthorizesRequests;

    public array $plan = [];

    protected $rules = [
        'plan.name' => 'required',
        'plan.description' => 'required',
        'plan.price' => 'required',
        'plan.slug' => 'required',
    ];

    public function createPlan()
    {
        try {
            $this->validate();
            $plan = $this->plan;

            // cria plano no pagseguro
            $planPagSeguroReference = (new PlanCreateService())->makeRequest($plan);

            $plan['reference'] = $planPagSeguroReference;
            Plan::create($plan);
            session()->flash('message', 'Plano Criado com Sucesso');
            return redirect()->route('plans.index'  );

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function render()
    {
        $this->authorize('check.user.is.admin');
        return view('livewire.plan.plan-create');
    }

}
