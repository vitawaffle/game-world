<?php

namespace App\Service;

use App\DTO\UserDTO;

interface UserService extends Service
{
    public function updateActiveUser(UserDTO $user): void;
}