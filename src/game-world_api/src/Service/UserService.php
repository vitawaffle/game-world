<?php

namespace App\Service;

use App\DTO\UserDTO;

interface UserService extends Service
{
    public function updateUser(UserDTO $user): void;
}