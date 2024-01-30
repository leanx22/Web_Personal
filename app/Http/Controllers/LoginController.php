<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //verificar si ya se esta logueado mediante un MW que verifique la existencia de la variable de sesion
    //verificar existencia del usuario
    //verificar contrasena
    //guardar variable de sesion y redireccionar.

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
            return route('dashboard.index');
        }

        return 'con algo troleaste';
    }

}
