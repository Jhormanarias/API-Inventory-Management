<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Services\Auth\RegisterService;

class RegisterController extends Controller
{

    public function __construct(
        protected RegisterService $service,
    ) {}

    public function register(RegisterRequest $request): RegisterResource
    {
        $newUser = $this->service->store($request->validated());

        return new RegisterResource($newUser);
    }
}
