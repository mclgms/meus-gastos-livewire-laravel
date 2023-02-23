<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;

class ExpenseList extends Component
{
    public function render()
    {
        $expenses = auth()->user()->expenses()->count()
            ? auth()->user()->expenses()
                ->orderBy('created_at','desc')
                ->paginate(10)
            : [];

        return view('livewire.expense.expense-list',
            compact('expenses'));
    }

    public function remove(Expense $expense)
    {
        $exp = auth()->user()->expenses()->find($expense->id);
        $exp->delete();
        session()->flash('message', 'Registro excluído com sucesso');
    }
}
