<?php

namespace App\Service;

use App\Repository\UserRepository;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function login(string $username, string $password): void
    {
    }

    public function signin(string $username, string $password): void
    {
    }

    public function logout(): void
    {
    }
}
