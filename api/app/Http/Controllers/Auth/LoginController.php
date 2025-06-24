<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Auth\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $service,
    ) {}

    public function login(LoginRequest $request)
    {
        return $this->service->handleLogin($request->validated());
    }
}
