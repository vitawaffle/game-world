<?php

namespace App\Service;

use App\Entity\User;
use App\DTO\SigninDTO;

interface AuthService extends Service
{
    public function signin(SigninDTO $signinDTO): void;
    public function getUser(): User;
}
