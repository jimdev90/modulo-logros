<?php

namespace App\Http\Controllers\Auth;

use App\Enums\EstadoUserType;
use App\Enums\UserStatusType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ActivateUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Saga\BasicPersonal;
use App\Models\Saga\PersonalBasica;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginCustomController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::DASHBOARD);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
