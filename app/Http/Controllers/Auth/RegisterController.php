<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|confirmed|min:8',
                'lastName' => 'required|string|max:255',
                'address' => 'required|string|max:250',
                'rol' => 'nullable|string',
                'birthdate' => 'required|date|before:-18 years',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $birthdate = Carbon::createFromFormat('d-m-Y', $request->input('birthdate'))->format('Y-m-d');
            $user = User::create([
                'name' => $request->input('name'),
                'lastName' => $request->input('lastName'),
                'address' => $request->input('address'),
                'rol' => $request->input('rol', 'user'),
                'birthdate' => $birthdate,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')), // Asignación del valor predeterminado "owner"
            ]);
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
