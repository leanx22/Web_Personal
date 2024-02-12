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

    public function logInAPI(Request $request)//no usar por ahora
    {
        $data = [
            "status" => 404,
            "message" => "Las credenciales no corresponden a un usuario registrado",
            "JWT" => null,
        ];

        $user = User::where('email',$request->email)->first();

        
        if(!($user!=null && Hash::check($request->password, $user->password)))
        {
            return response()->json($data)->setStatusCode($data["status"]);
        }
        
        $JWT = $this->getToken($user,30);
        $data["status"] = 200;
        $data["message"] = "Token generado";
        $data["JWT"] = $JWT;

        return response()->json($data)->setStatusCode($data["status"]);
    }

    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $user_info = $request->only('email','password');
               
        if(!Auth::attempt($user_info))
        {        
            return redirect()->route('login');
        }


        $user = User::where('email',$request->email)->first();
        $jwt_cookie = $this->getToken($user,30);
        $response = new Response();
        
        //Evitar session fixation.
        request()->session()->regenerate();
        $response->cookie("JWT_AUTH_COOKIE",$jwt_cookie,30,'/','',false,false);
        return redirect()->route('index');
    }

}
