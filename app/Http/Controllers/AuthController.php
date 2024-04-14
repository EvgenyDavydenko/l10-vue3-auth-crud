<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // REGISTER API
    public function register(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        // create data
        $u = new User();
        
        $u->name = $request->name;
        $u->email = $request->email;
        $u->password = Hash::make($request->password);
        $u->phone_no = isset($request->phone_no) ? $request->phone_no : "";

        $u->save();

        // send response
        return response()->json([
            "status" => 1,
            "message" => "User registered succesfully"
        ], 201);
    }

    // LOGIN API
    public function login(Request $request)
    {
        // validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // check student
        $u = User::where("email", "=", $request->email)->first();

        if(isset($u->id)){

            if(Hash::check($request->password, $u->password)){

                // create a token
                $token = $u->createToken("auth_token")->plainTextToken;

                /// send a response
                return response()->json([
                    "status" => 1,
                    "message" => "User logged in successfully",
                    "access_token" => $token
                ]);
            }else{

                return response()->json([
                    "status" => 0,
                    "message" => "Password didn't match"
                ], 404);
            }
        }else{

            return response()->json([
                "status" => 0,
                "message" => "User not found"
            ], 404);
        }
    }
 
    // PROFILE API
    public function profile()
    {
        return response()->json([
            "status" => 1,
            "message" => "User Profile information",
            "data" => auth()->user()
        ]);
    }

    // LOGOUT API
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => 1,
            "message" => "User logged out successfully"
        ]);
    }
}
