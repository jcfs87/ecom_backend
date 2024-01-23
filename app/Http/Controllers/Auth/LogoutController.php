<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                throw ValidationException::withMessages([
                    'message' => ['User not authenticated'],
                ]);
            }

            // Obtener el primer token del usuario (asumiendo que un usuario puede tener varios tokens)
            $token = $user->tokens->first();

            if ($token) {
                $token->delete();
                return [
                    'message' => 'You have successfully logged out'
                ];
            } else {
                throw new \Exception('No token found for the user');
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
