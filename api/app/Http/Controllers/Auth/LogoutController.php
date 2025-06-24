<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\LogoutService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct(
        protected LogoutService $service,
    ) {}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.'
        ]);
    }
}
