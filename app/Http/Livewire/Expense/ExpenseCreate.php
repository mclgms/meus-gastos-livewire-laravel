<?php

namespace App\Http\Livewire\Expense;

use App\Traits\Subscription\SubscriptionTrait;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads, SubscriptionTrait;

    public $expense = [];

    protected $rules = [
        'expense.description' => 'required',
        'expense.amount' => 'required',
        'expense.type' => 'required',
        'expense.photo' => 'image|nullable'
    ];

    public function render()
    {
        return view('livewire.expense.expense-create')
            ->with('viewFeatures', $this->loadFeaturesByUserPlan('view'));
    }

    public function createExpense()
    {
        $this->validate();

        if (isset($this->expense['photo']) && $this->expense['photo']) {
            $this->expense['photo'] = $this->expense['photo']->store('expenses-photos', 'public');
        }

        $this->expense['photo'] = $this->expense['photo'] ?? null;
        $expense = auth()->user()->expenses()->create($this->expense);
        if (isset($this->expense['categories']) && count($this->expense['categories'])) {
            $expense->categories()->sync($this->expense['categories']);
        }


        session()->flash('message', 'Registro salvo com sucesso');
        $this->reset('expense');

    }
}
