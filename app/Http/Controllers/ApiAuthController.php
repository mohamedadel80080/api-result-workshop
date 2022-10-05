<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{



    public function handleRegister(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:100',
            'password'=>'required|string|max:50|min:8'
                    ]);

        if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors);
                                }

        $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=>Hash::make ($request->password),
                'access_token' =>str::random(64),

    ]);
    
    return response()->json($user->access_token);
    }

//handlelogin function use to validator date on datebase and user input and login
//step 1 Validator
//step 2 if error use validator errors library
//step 3 else login and update access tocken

public function handlelogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|max:100',
            'password'=>'required|string|max:50|min:8'
                    ]);
        if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json($errors);
                }//else
                    $is_user= Auth::attempt(['email'=> $request->email,'password'=> $request->password]);

        if(! $is_user ){
                $error=("credentials are not correct");
                return response()->json($error);
                }//else
                    $user= User::where('email','=', $request->email)->first();

        $new_access_token = str::random(64);
        $user->update(['access_token'=> $new_access_token]);
        return response()->json($new_access_token);
    }


//logout function  validator request on datebase use access_token if found this  access_token update status 'Null'
public function logout(Request $request)

    {
        $access_token = $request-> access_token;
        $user = User::where('access_token',$access_token)->first();

        if($user == null){
            $error=("TOCKEN ERROR");
            return response()->json($error);
            }//else
                $user->update(['access_token'=>NULL]);
                $saccess= "logged out successfully";
                return response()->json( $saccess);

    }

}
