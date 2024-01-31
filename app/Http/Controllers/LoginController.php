<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $user_info = $request->only('email','password');
        
        if(Auth::attempt($user_info))
        {
            //Evitar session fixation.
            request()->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login');
    }

}
