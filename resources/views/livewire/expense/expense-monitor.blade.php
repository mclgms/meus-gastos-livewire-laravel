<div class="w-full flex justify-between p-5">
    <div class="w-1/4 h-30 p-15 bg-green-600 text-white text-2xl font-extrabold flex flex-col justify-center items-center rounded">
        <strong>Entrada</strong><br>

        R$ {{isset($expenseCount[1]) ? number_format($expenseCount[1], 2, ',', '.') : 0 }}
    </div>

    <div class="w-1/4 h-30 p-15 bg-red-600 text-white text-2xl font-extrabold flex flex-col justify-center items-center rounded">

        <strong>Saída</strong><br>
        R$ {{isset($expenseCount[2]) ? number_format($expenseCount[2], 2, ',', '.') : 0 }}
    </div>

    <div class="w-1/4 p-15 justify-center items-center h-30 text-white text-2xl font-extrabold flex flex-col justify-center items-center rounded
        @if($showBalance > 0)
        bg-green-600
        @else
        bg-red-600
        @endif
    ">
        <strong>Saldo</strong><br>
        R$ {{number_format($showBalance, 2, ',', '.')}}
    </div>
</div>
