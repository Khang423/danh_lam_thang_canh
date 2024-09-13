<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowUser = [
            
        ];
        if (Auth::check() && in_array(Auth::user()->user_type, $allowUser )) {
            return redirect()->route('admin.dashboard');
        }

        return response()->view('admin.login');
    }
}
