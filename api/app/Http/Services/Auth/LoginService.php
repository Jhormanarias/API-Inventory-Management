<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Throwable;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginService
{
    public function handleLogin(array $credentials)
    {
        try {
            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json(['message' => 'Credenciales incorrectas'], 401);
            }

            // Generar token
            $token = $user->createToken('api_token')->plainTextToken;

            // Retornar solo el token
            return response()->json(['token' => $token]);
        } catch (Throwable $th) {
            throw ValidationException::withMessages([
                'error' => $th->getMessage(),
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
