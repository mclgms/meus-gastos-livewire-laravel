<?php

namespace App\Http\Middleware\Subscription;

use App\Traits\Subscription\SubscriptionTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAmountOfExpenseUserPlan
{
    use SubscriptionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->userCanCreateNewExpense()) {
            session()->flash('message','Número máximo de registros foi alcançado!');
            return redirect()->route('expenses.index');
        }

        return $next($request);
    }
}
