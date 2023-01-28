<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class authController extends Controller
{
    
    //
    public function register(Request $request){
        // dd($request);
        $validator = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required|email',
                'password'=>'required',
                'c_password'=>'required|same:password'
            ]
         );

        if ($validator->fails()) {
            $response=[
                'success'=>false,
                'message'=>$validator->errors(),
            ];
            return response()->json($response,400);
        } else {
            $input= $request->all();
            $input['password']=bcrypt($input['password']);
            $user=User::create($input);

            $success['token']=$user->createToken('authToken')->plainTextToken;
            $response= [
                'success'=>true,
                'data'=>$success,
                'message'=>'User Registered Succesfully'
            ];
            return response()->json($response,201);
        }
        // $response= [
        //             'success'=>true,
        //             'data'=>[],
        //             'message'=>'User Registered Succesfully'
        //         ];
        // return response()->json($response,201);
    }

    public function login(Request $req){
        // dd($req);
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password])){
            $user=Auth::user();
        //    dd($user);
            $success['token']=$user->createToken('authToken')->plainTextToken;
            $response= [
                'success'=>true,
                'data'=>$success,
                'message'=>'User Login Succesfully'
            ];
            return response()->json($response,201);
        }else{
            $response=[
                'success'=>false,
                'message'=>'Unauthorised',
            ];
            return response()->json($response,201);
        }
    }
}
