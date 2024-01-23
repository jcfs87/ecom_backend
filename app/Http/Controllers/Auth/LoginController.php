<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class LoginController extends Controller
{
    public function loginCheck(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|',
                'password' => 'required|string|min:8'
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                 ], 401);
            }
            return response()->json([
                'message' => 'User successfully logged in',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                // 'token' => $token, 'token_type' => 'Bearer',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
