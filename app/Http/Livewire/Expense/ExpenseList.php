<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\Expense;
use Livewire\WithPagination;

class ExpenseList extends Component
{
    use WithPagination;

    protected $queryString = [
        'search','take','type','orderBy','orderByField'
    ];

    public $search;
    public $type;
    public $take;

    public $orderBy = 'DESC';
    public $orderByField = 'created_at';


    public function render()
    {
        $expenses = auth()->user()->expenses()->orderBy($this->orderByField, $this->orderBy);

        $expenses->when($this->search, function($queryBuilder) {
            return $queryBuilder->where('description','like','%'.$this->search.'%');
        });

        $expenses->when($this->type, function($querBuilder){
            return $querBuilder->where('type',$this->type);
        });

        $expenses = $this->take ? $expenses->paginate($this->take) : $expenses->get();

        $expenses = auth()->user()->expenses()->count()
            ? $expenses
            : [];

        return view('livewire.expense.expense-list',
            compact('expenses'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function remove(Expense $expense)
    {
        $exp = auth()->user()->expenses()->find($expense->id);
        $exp->delete();
        session()->flash('message', 'Registro excluído com sucesso');
    }

    public function changeOrder($orderField, $orderBy = null)
    {
        $this->orderByField = $orderField;
        $this->orderBy = $this->orderBy == 'DESC' ? 'ASC' : 'DESC';
    }

}
