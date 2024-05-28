<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return response()->json([
            'data' =>$users,
            'msg' => 'Get all users',
            'status' => 200
        ]);
    }
    public function store(Request $request){
        $validate = Validator::make($request->all() ,
        [
            'name' => 'required:users',
            'email' => 'required|email|unique:users',
            'password' => 'min:8|required:users',
        ],
        [
            'name.required' => 'name is required',
            'email.email' => 'email is contain @',
        ]
        );
            // fails = false /  fails = true
        if($validate->fails()){
            return  response()->json([
                'errors' => $validate->errors(),
                'status' => 400
            ]);
        }

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('register_token')->plainTextToken;

        return response()->json([
            'data' =>$user,
            'token' =>$token,
            'msg' => 'Create user Successfully',
            'status' => 200
        ]);
    }



    // --- login ----
    public function login(Request $request){
        $validate = Validator::make($request->all() ,
        [
            'email' => 'required|email:users',
            'password' => 'min:8|required:users',
        ]
        );
            // fails = false /  fails = true
        if($validate->fails()){
            return  response()->json([
                'errors' => $validate->errors(),
                'status' => 400
            ]);
        }
            // check email
        $user = User::where('email' , $request->email)->first();
            // check password
        if($user && Hash::check($request->password , $user->password)){
            $token = $user->createToken('login_token')->plainTextToken;
            // response is true
            return response()->json([
                'data' => 'go to home page',
                'token' => $token,
                'msg' => 'login user successfully',
                'status' => 200
            ]);
        }
        
        // response is false
        return response()->json([
            'msg' => 'login user failed',
            'status' => 403
        ]);
    }
}
