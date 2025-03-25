<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    public function __construct(public readonly User $user){}

    public function register(array $data): array
    {
        return $this->user->create($data)->toArray();
    }

    public function login(array $data): array
    {
        $user = $this->user->where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return [];
        }
        $user->token = $user->createToken('auth_token')->plainTextToken;

        return $user->toArray();
    }
}
