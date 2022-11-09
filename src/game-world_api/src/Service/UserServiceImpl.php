<?php

namespace App\Service;

use App\DTO\UserDTO;
use App\Repository\UserRepository;
use App\Service\AuthService;

class UserServiceImpl implements UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly AuthService $authService,
    ) {
    }

    public function updateActiveUser(UserDTO $user): void
    {
        $this->userRepository->save(
            $this->authService->getUser()->updateByDTO($user),
            true
        );
    }
}
