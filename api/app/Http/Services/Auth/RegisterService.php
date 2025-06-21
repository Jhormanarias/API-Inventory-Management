<?php

namespace App\Http\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterService
{
    /**
     * Store and evaluate a new accounting formula.
     */
    public function store(array $user): User
    {
        try {
            $newUser = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'role' => $user['role'], // ya tiene default desde el request
        ]);

        return $newUser;
        } catch (Throwable $th) {
            throw ValidationException::withMessages([
                'error' => $th->getMessage(),
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
        
    }
}