<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public  AdminAuthService $adminAuthService;

    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }

    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request) 
    {
        $result =$this->adminAuthService->login($request);
        if($result && $result['status'] == true) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->withErrors([
            'login_errors' => $result['message'],
        ]);
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('admin.login');
    }
}
