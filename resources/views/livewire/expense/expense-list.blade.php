<div class="max-w-7xl mx-auto py-15 px-4">
    <x-slot name="header">
        <h2>Meu Registros</h2>
    </x-slot>

    <div class="w-full mx-auto text-right mb-4 mt-2">
        <a href="{{route('expenses.create')}}"
           class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Criar
            Registro</a>
    </div>

    @include('includes.message')

    <table class="table-auto w-full mx-auto">
        <thead>
        <tr class="text-left">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Descrição</th>
            <th class="px-4 py-2">Valor</th>
            <th class="px-4 py-2">Data Registro</th>
            <th class="px-4 py-2">Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($expenses as $exp)
        <tr>
            <td class="px-4 py-2 border"> {{$exp->id}}</td>
            <td class="px-4 py-2 border">{{$exp->description}}</td>
            <td class="px-4 py-2 border">
                <span class="{{ $exp->type === 1 ? 'text-green-700' : 'text-red-900'}}">
                    {{ $exp->type == 1 ? '' : '-' }}
                    {{number_format($exp->amount,2,',','.')}}
                </span>
            </td>
            <td class="px-4 py-2 border">
                {{$exp->expense_date
                ? (\DateTime::createFromFormat('Y-m-d H:i:s', $exp->expense_date))->format('d/m/Y H:i:s')
                : $exp->created_at->format('d/m/Y H:i:s')}}
            </td>
            <td class="px-4 py-2 border">
                <a href="{{route('expenses.edit',$exp->id)}}" class="px-4 py-2 border rounded bg-teal-500 text-white">Editar</a>
                <a href="#" wire:click.prevent="remove({{$exp->id}})"
                   class="px-4 py-2 border rounded bg-red-500 text-white">Remover</a>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="5" align="center">
                    <span class="md:text-2xl">Nenhum registro encontrado.</span>
                </td>
            </tr>

        @endforelse
        </tbody>
    </table>
    <div class="w-full mx-auto mt-10">
        @if(count($expenses))
            {{$expenses->links()}}
        @else
        <div class="text-center">
            <span class="md:text-2xl">Nenhum registro encontrado.</span>
        </div>
        @endif
    </div>

</div>
