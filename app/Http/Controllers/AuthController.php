<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use HttpResponses;
    public function Login(LoginUserRequest $request)
    {
        //$request->validate($request->all());
     if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
     {
        return $this->error('','Donne email et mot de passe correct',401);
     }
     else
     {
        $User = user::where('email','=',$request->email)->first();
        return $this->succes(
            [
            'User' => $User,
            'Token' =>   $User->createToken('Api token of '.$User->name)->plainTextToken
            
        ],'Bien Log in');
     }
        
     





         
    }
    public function Register(StoreUserRequest $request)
    {


        //$request->validate($request->all());
        $User = User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password)
        ]);
        return $this->succes([
           'User' =>  $User,
           'token' => $User->createToken('Api token of '.$User->name)->plainTextToken
        ]);
    }
    public function Logout()
    {
        return response()->json('This is logout methode');
    }
}
