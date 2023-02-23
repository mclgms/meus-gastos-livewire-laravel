<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;

    public $amount;
    public $description;
    public $type;
    public $photo;
    public $expenseDate;

    protected $rules = [
        'description' => 'required',
        'amount' => 'required',
        'type' => 'required',
        'photo' => 'image|nullable'
    ];

    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();

        if ($this->photo) {
            $this->photo = $this->photo->store('expenses-photos', 'public');
        }

        auth()->user()->expenses()->create([
            'description' => $this->description,
            'amount' => $this->amount,
            'type' => $this->type,
            'user_id' => auth()->user()->id,
            'photo' => $this->photo ?? null,
            'expense_date' => $this->expenseDate
        ]);
        session()->flash('message', 'Registro salvo com sucesso');
        $this->description = $this->amount =
            $this->type = $this->photo = $this->expenseDate = NULL;

    }
}
