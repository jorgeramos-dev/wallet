<?php

namespace App\Http\Controllers\Auth;

use App\DTO\Auth\AuthLoginDTO;
use App\DTO\Auth\AuthRegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Resources\Auth\AuthLoginResource;
use App\Http\Resources\Auth\AuthRegisterResource;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService){}

    /**
     * Handle user register.
     *
     * @param AuthRegisterRequest $request
     * @return AuthRegisterResource
     */
    public function register(AuthRegisterRequest $request): AuthRegisterResource
    {
        $user = $this->authService->register(AuthRegisterDTO::fromArray($request->validated()));
        return new AuthRegisterResource((object) $user);
    }


    /**
     * Handle use login.
     *
     * @param AuthLoginRequest $request
     * @return AuthLoginResource
     */
    public function login(AuthLoginRequest $request): AuthLoginResource
    {
        $user = $this->authService->login(AuthLoginDTO::fromArray($request->validated()));
        if (empty($user)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return new AuthLoginResource((object) $user);
    }
}
