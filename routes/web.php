<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\File;

use \App\Http\Livewire\Plan\PlanList;
use \App\Http\Livewire\Plan\PlanCreate;

use \App\Http\Livewire\Payment\CreditCard;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('expenses')->name('expenses.')->group(function () {

        Route::get('/create', App\Http\Livewire\Expense\ExpenseCreate::class)->name('create');
        Route::get('/edit/{expense}', App\Http\Livewire\Expense\ExpenseEdit::class)->name('edit');
        Route::get('/list', App\Http\Livewire\Expense\ExpenseList::class)->name('index');

        Route::get('/{expense}/photo', function (\App\Models\Expense $expense) {
            $expense = auth()->user()->expenses()->find($expense->id);
            if (!Storage::disk('public')->get($expense->photo)) {
                return abort(404, 'Imagem não existe');
            }

            // pega mimeType do arquivo
            $mimeType = File::mimeType(storage_path('app/public/' . $expense->photo));

            // pegar imagem e retornar imagem
            $image = Storage::disk('public')->get($expense->photo);
            return response($image)->header('Content-Type', $mimeType);
        })->name('photo');

    });

    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('/', PlanList::class)->name('index');
        Route::get('/create', PlanCreate::class)->name('create');
    });

});

Route::get('/subscription', CreditCard::class)
    ->name('plan.subscription');
