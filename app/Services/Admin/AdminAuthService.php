<?php

namespace App\Services\Admin;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthService
{
    public function login($request)
    {
        $rememberMe = $request['remember_me'] ? true : false;
        $user = User::where('email', $request['user_identifier'])->orWhere('tel', $request['user_identifier'])->first();
        if ($user && in_array($user->user_type, [UserTypeEnum::ROOT_ADMIN->value, UserTypeEnum::MEMBER_ADMIN->value])) {
            if (Hash::check($request['password'], $user['password'])) {
                Auth::guard('admin')->login($user, $rememberMe);
                return [
                    'status' => true,
                    'data' => $user,
                ];
            }
        }

        return [
            'status' => false,
            'message' => __('messages.wrong_login_id_or_password'),
        ];
    }
}