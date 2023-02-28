<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use App\Traits\Subscription\SubscriptionTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseEdit extends Component
{
    use WithFileUploads, SubscriptionTrait, AuthorizesRequests;

    protected $rules = [
        'description' => 'required',
        'amount' => 'required',
        'type' => 'required',
        'photo' => 'image|nullable'
    ];

    public Expense $expense;
    public $categories = [];
    public $description = '';
    public $amount = '';
    public $type = '';
    public $photo;
    public $expense_date;

    public function mount()
    {
        $this->description = $this->expense->description;
        $this->amount = number_format($this->expense->amount,2,',','.');
        //$this->amount = $this->expense->amount;
        $this->type = $this->expense->type;
        $this->expense_date = $this->expense->expense_date  ? Expense::formatExpenseDateBR($this->expense->expense_date) : '';
        $this->categories = $this->expense->categoriesArr;
    }

    public function render()
    {
        $this->authorize('check.user.can.edit.expense', $this->expense);

        return view('livewire.expense.expense-edit')
            ->with('viewFeatures', $this->loadFeaturesByUserPlan('view'));
    }

    public function updateExpense()
    {
        $this->validate();

        if ($this->photo) {
            // remove a photo atual
            if (Storage::disk('public')->exists($this->expense->photo)) {
                Storage::disk('public')->delete($this->expense->photo);
            }
            $this->photo = $this->photo->store('expenses-photos','public');
        }

        $this->expense->update([
            'description' => $this->description,
            'amount' => $this->amount,
            'type' => $this->type,
            'photo'=> $this->photo ?? $this->expense->photo,
            'expense_date'=>$this->expense_date
        ]);
        if (count($this->categories)) {
            $this->expense->categories()->sync($this->categories);
        }
        session()->flash('message', 'Registro atualizado com sucesso');

    }
}
