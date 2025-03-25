<?php

namespace App\Interfaces;

interface AuthInterface
{
    public function register(array $data): array;

    public function login(array $data): array;
}
