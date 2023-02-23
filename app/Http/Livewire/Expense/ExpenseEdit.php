<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseEdit extends Component
{
    use WithFileUploads;

    protected $rules = [
        'description' => 'required',
        'amount' => 'required',
        'type' => 'required',
        'photo' => 'image|nullable'
    ];

    public Expense $expense;
    public $description = '';
    public $amount = '';
    public $type = '';
    public $photo;
    public $expenseDate;

    public function mount()
    {
        $this->description = $this->expense->description;
        $this->amount = $this->expense->amount;
        $this->type = $this->expense->type;
        $this->expense_date = $this->expense->expense_date;
    }

    public function render()
    {
        return view('livewire.expense.expense-edit');
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
            'photo'=> $this->photo ?? $this->expense->photo
        ]);
        session()->flash('message', 'Registro atualizado com sucesso');

    }
}
