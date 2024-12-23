<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // First check if user is not authenticated
        if (!Auth::guard('student')->check()) {
            return redirect()->route('login');
        }

        // Then check if authenticated but not approved
        if (!Auth::guard('student')->user()->approved) {
            Auth::guard('student')->logout();
            return redirect()->route('login')->with('message', 'Your Account still needs Login Approval');
        }

        return $next($request);
    }
}
