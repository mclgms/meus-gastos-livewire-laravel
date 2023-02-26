<?php

namespace App\Http\Middleware\Subscription;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserHasAValidSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userPlan = auth()->user()->plan();
        if (!$userPlan->exists()) {
            Auth::logout();
            return redirect()->route('login');
        }
        //return $next($request);
        return redirect()->route('dashboard');
    }
}
