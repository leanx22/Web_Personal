<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\User;

use Illuminate\Http\Response;

class LoginController extends Controller
{

    public function getToken(User $user, int $exp_time)
    {
        $key = env("JWT_SECRET");
        $now = time();

        $payload = [
            "username" => $user->username,
            "profile" => Profile::where('id',$user->profile_id)->first(),
            "exp" => $now + ($exp_time*60),
        ];

        return JWT::encode($payload,$key,'HS256');
    }

    public static function checkToken($token):bool
    {
        $key = env('JWT_SECRET');
        try{
            $decode = JWT::decode($token,$key);
        }catch(\Throwable $e){
            return false;
        }
        return true;
    }

    public function showLoginForm()
    {
        return view('Auth.login');
    }

    //Funcion llamada por la ruta API, la cual otorga un JWT al cliente.
    public function loginAPI(Request $request)
    {
        $data = [
            "status" => 404,
            "message" => "Las credenciales no corresponden a un usuario registrado",
            "JWT" => null,
        ];
        
        $user_info = $request->only('email','password');
               
        if(!Auth::attempt($user_info))
        {        
            return response()->json($data)->setStatusCode($data["status"]);
        }
        
        //$request->session()->regenerate();
        $user = User::where('email',$user_info["email"])->first();

        $JWT = $this->getToken($user,30);
        
        $data["status"] = 200;
        $data["message"] = "Sesion iniciada!";
        $data["JWT"] = $JWT;

        return response()->json($data)->setStatusCode($data["status"]);
    }    

    //Loguea al usuario normalmente.
    public function login(Request $request)
    {
        $user_info = $request->only('email','password');
               
        if(!Auth::attempt($user_info))
        {        
            return redirect()->route('login');
        }
        
        //Evitar session fixation.
        request()->session()->regenerate();
        return redirect()->route('index');
    }

    public function logOut()
    {
        Auth::logout();
        return response()->json(["seccess"=>true])->setStatusCode(200);
    }

}
