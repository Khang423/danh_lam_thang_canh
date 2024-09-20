<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowUser = [
            UserTypeEnum::ROOT_ADMIN->value,
            UserTypeEnum::MEMBER_ADMIN->value,
        ];
        if (Auth::check() && in_array(Auth::user()->user_type, $allowUser )) {
            return $next($request);
        }

        return redirect()->route('admin.loginView');
    }
}
