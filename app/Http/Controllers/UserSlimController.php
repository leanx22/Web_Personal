<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class UserSlimController extends Controller
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

    public function logIn(Request $request)
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
        $data["message"] = "Sesion iniciada";
        $data["JWT"] = $JWT;

        return response()->json($data)->setStatusCode($data["status"]);
    }
}
