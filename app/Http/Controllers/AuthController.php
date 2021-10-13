<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function Register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' =>'required',
        //     'email' =>'required|email',
        //     'password' =>'required'
        // ]);
        // if($validator->fails()){
        //     return response()->json(['status_code'=>400 , 'message' =>'Bad Request']);
        // }
        $this->validate($request,[
            'name' =>'required',
           'email' =>'required|email',
           'password' =>'required|confirmed'
        ]);
        $user =new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'status_code'=>200,
            'message'=>'User Created Successfully'
        ]);
    } 


    public function Login(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'email' =>'required|email',
            'password' =>'required'
        ]);
        if($validator->fails()){
            return response()->json(['status_code'=>400 , 'message' =>'Bad Request']);
        }
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'status_code'=>500,
                'message'=>'Unauthorizaied'
            ]);
        }
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authtoken')->plainTextToken;
        return response()->json([
            'status_code'=>200,
            'token'=>$tokenResult
        ]);
    }
    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code'=>200,
            'message'=>'Token Deleted Successfully'
        ]);
    }
}
