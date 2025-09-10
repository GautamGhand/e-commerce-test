<?php

namespace App\Http\Controllers\Web\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        return view('customer.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember_me = $request->remember_me == 'on' ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            return Redirect::route('home');
        }

        return Redirect::back()->withErrors('Invalid Credentails!');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();
        Auth::logout();
        return Redirect::route('home')->withSuccess('Logged Out Successfully!');
    }
}
