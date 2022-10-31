<?php

namespace App\Service;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\{UserRepository, RoleRepository};
use App\Entity\User;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $userRepository,
        private readonly RoleRepository $roleRepository,
    ) {
    }

    public function login(User $user): string
    {
        return '';
    }

    public function signin(string $username, string $password): void
    {
        $user = new User(
            username: $username,
            password: $password,
            roles: [
                $this->roleRepository->findByName('USER'),
            ],
        );

        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->userRepository->save($user, true);
    }

    public function logout(): void
    {
    }
}
