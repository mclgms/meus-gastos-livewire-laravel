<div class="max-w-7xl mx-auto py-15 px-4" x-data>
    <navigation-menu/>
    <x-slot name="header">
        <h2>Editar Registro</h2>
    </x-slot>
    @include('includes.message')
    <form action="" wire:submit.prevent="updateExpense" class="w-full max-w-7xl mx-auto">
        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Descrição</label>
            <input
                type="text"
                name="description"
                wire:model="description"
                class="block appearance-none w-full bg-gray-200 border @error('description') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
            @error('description')
        <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
        @enderror
        </p>

        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Valor</label>
            <input
                type="text"
                name="amout"
                x-mask:dynamic="$money($input, '.', ' ')"
                wire:model="amount"
                class="block appearance-none w-full bg-gray-200 border @error('description') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
            @error('amount')
        <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
        @enderror
        </p>
        <p>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo</label>
            <select wire:model="type" name="type" id=""
                    class="block appearance-none w-full bg-gray-200 border @error('type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">>
                <option value="">Selecione</option>
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>
            @error('type')
        <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
        @enderror
        </p>

        <p class="w-full px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Data Registro</label>
            <input
                type="text"
                name="expense_date"
                wire:model="expense_date"
                x-mask="99/99/9999 99:99:99"
                placeholder="00/00/0000 00:00:00"
                class="block appearance-none w-full bg-gray-200 border @error('expense_date') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>
            @error('expense_date')
        <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
        @enderror


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
                name="amount"
                wire:model="photo"
                class="block appearance-none w-full bg-gray-200 border @error('photo') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"/>

            @error('photo')
                <h5 class="text-red-500 text-xs italic">{{$message}}</h5>
            @enderror
        </p>

        @if(isset($expense['photo']) && $expense['photo'])        <div class="w-full py-4 px-3 mb-6 md:mb-0">
            <img
                width="500"
                height="500"
                src="{{route('expenses.photo',$expense->id)}}" alt="{{$description}}">
        </div>
        @endif


        <div class="w-full py-4 px-3 mb-6 md:mb-0">
            <button type="submit"
                    class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
            >Salvar Registro</button>
            <a href="javascript:history.back()" class="flex-shrink-0 bg-gray-100 hover:bg-gray-200 border-gray-200 hover:border-gray-300 text-sm border-4 text-black py-1 px-2 rounded">Voltar</a>
        </div>
    </form>


</div>

