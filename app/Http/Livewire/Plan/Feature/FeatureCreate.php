<?php

namespace App\Http\Livewire\Plan\Feature;

use App\Models\Plan;
use Illuminate\Support\Str;
use Livewire\Component;

class FeatureCreate extends Component
{
    public $feature = [];
    public $plan;

    protected $listeners = [
        'openModal'
    ];

    protected $rules = [
        'feature.name' => 'required',
        'feature.type' => 'required',
        'feature.rule' => 'required'
    ];

    public function openModal($planId)
    {
        $this->plan = Plan::find($planId);
    }

    public function addFeature()
    {
        $this->validate();
        $this->feature['slug'] = Str::slug($this->feature['name']);
        $response = $this->plan->features()->create($this->feature);
        if ($response) {
            $this->reset('feature');
            $this->closeModal(true);
        }
    }

    public function closeModal($message = false)
    {
        $this->plan = null;

        $this->emit('closeModal',$message);
    }

    public function render()
    {
        return view('livewire.plan.feature.feature-create');
    }
}
