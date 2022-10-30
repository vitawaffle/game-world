<?php

namespace App\Service;

interface AuthService extends Service
{
    public function login(string $username, string $password): void;
    public function signin(string $username, string $password): void;
    public function logout(): void;
}
