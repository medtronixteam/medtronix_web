<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginApiController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->is_disabled === 'yes') {
                Auth::logout();

                return response()->json(['error' => 'Your account is disabled. Please contact support for assistance.'], 400);
            }
           $token= $user->createToken('my-app-token')->plainTextToken;
            // $token = $user->createToken('auth_token')->plainTextToken;
            // return response()->json(['success' => 'Login successful', 'access_token' => $token, 'token_type' => 'Bearer'], 200);
            return response()->json(['message' => 'Login successful','status'=>'success','token',$token], 200);

        }

        return response()->json(['message' => 'Invalid email or password','status'=>'error'], 401);
    }
}
