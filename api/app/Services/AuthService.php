<?php

namespace App\Services;

use App\DTO\Auth\AuthLoginDTO;
use App\DTO\Auth\AuthRegisterDTO;
use App\Repositories\AuthRepository;

class AuthService
{
    public function __construct(private readonly AuthRepository $authRepository){}

    public function register(AuthRegisterDTO $dto): array
    {
        return $this->authRepository->register([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password)
        ]);
    }

    public function login(AuthLoginDTO $dto): array
    {
        return $this->authRepository->login([
            'email' => $dto->email,
            'password' => $dto->password
        ]);
    }
}
