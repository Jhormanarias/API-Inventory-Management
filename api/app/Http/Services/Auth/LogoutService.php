<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LogoutService
{
    public function destroy(array $user)
    {
        $authUser = Auth::user();

        Log::info('User auth', $authUser);

        if (! $authUser) {
            $response = response()->json(['message' => 'Unauthenticated.'], ResponseAlias::HTTP_UNAUTHORIZED);
            return $response;
        }

        // Revoke all tokens...
        //$user->currentAccessToken()->delete();
    }
}


















