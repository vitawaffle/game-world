<?php

namespace App\Service;

interface AuthService extends Service
{
    public function signin(string $username, string $password): void;
}
