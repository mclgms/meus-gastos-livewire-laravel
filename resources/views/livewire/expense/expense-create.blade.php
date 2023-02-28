<div class="max-w-7xl mx-auto py-15 px-4" x-data>
    <navigation-menu/>
    <x-slot name="header">
        <h2>Criar uma Receita/Despesa</h2>
    </x-slot>
    @include('includes.message')
    <form action="" wire:submit.prevent="createExpense" class="w-full max-w-7xl mx-auto">
        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descrição</label>
            <input
                type="text"
                name="description"
                wire:model="expense.description"
                class="block appearance-none w-full bg-gray-200 border @error('expense.description') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
            @error('expense.description')
        <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
        @enderror
        </p>

        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Valor</label>
            <input
                type="text"
                name="amount"
                wire:model="expense.amount"
                class="block appearance-none w-full bg-gray-200 border @error('expense.amount') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
            @error('expense.amount')
        <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
        @enderror
        </p>
        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo</label>
            <select wire:model="expense.type" name="type" id=""
                    class="block appearance-none w-full bg-gray-200 border @error('expense.type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">>
                <option value="">Selecione</option>
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>
            @error('expense.type')
                <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
        </p>

        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data Registro</label>
            <input
                type="text"
                name="expense_date"
                id="expense_date"
                wire:model="expense.expense_date"
                x-mask="99/99/9999 99:99:99"
                placeholder="00/00/0000 00:00:00"
                class="block appearance-none w-full bg-gray-200 border @error('expense_date') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>

            @foreach($viewFeatures as $feature)
            @include('plan-features.'.'categories')
            @endforeach

        </p>



        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                Foto comprovante
            </label>
            <input
                type="file"
                name="photo"
                wire:model="expense.photo"
                class="block appearance-none w-full bg-gray-200 border @error('expense.photo') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>


            @if(isset($expense['photo']) && $expense['photo'] && !$errors->has('expense.photo'))
            <img
                width="500"
                height="500"
                src="{{$expense['photo']->temporaryUrl()}}" alt="">
        @endif
            @error('expense.photo')
                <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
        </p>

        <div class="w-full py-4 px-3 mb-10 md:mb-10">
            <button type="submit"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded disabled:opacity-25"
            >Criar Registro</button>
            <a href="{{route('expenses.index')}}" class="flex-shrink-0 bg-white hover:bg-gray-100 border-gray-300 hover:border-gray-100 text-sm border-4 text-black py-1 px-2 rounded">
                Voltar
            </a>
            <div wire:loading wire:target="createExpense">
                Salvando dados...
            </div>
        </div>
    </form>

</div>

