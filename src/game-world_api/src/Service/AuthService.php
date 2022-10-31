<?php

namespace App\Service;

use App\Entity\User;

interface AuthService extends Service
{
    public function login(User $user): string;
    public function signin(string $username, string $password): void;
    public function logout(): void;
}
