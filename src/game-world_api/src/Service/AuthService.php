<?php

namespace App\Service;

use App\Entity\User;

interface AuthService extends Service
{
    public function signin(string $username, string $password): void;
    public function getUser(): User;
}
