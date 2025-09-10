<?php

namespace App\Http\Controllers\Web\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember_me = $request->remember_me == 'on' ? true : false;

        if (Auth::attempt($credentials,$remember_me)) {
            return Redirect::route('admin.dashboard');
        }

        return Redirect::back()->withErrors('Invalid Credentails!');
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerate();
        Auth::logout();
        return Redirect::route('admin.login.index')->withSuccess('Logged Out Successfully!');
    }
}
