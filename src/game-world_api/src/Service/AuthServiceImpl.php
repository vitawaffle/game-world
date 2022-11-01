<?php

namespace App\Service;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\{UserRepository, RoleRepository};
use App\Entity\User;
use App\DTO\SigninDTO;

class AuthServiceImpl implements AuthService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly Security $security,
        private readonly UserRepository $userRepository,
        private readonly RoleRepository $roleRepository,
    ) {
    }

    public function signin(SigninDTO $signinDTO): void
    {
        $user = new User(
            username: $signinDTO->username,
            password: $signinDTO->password,
            email: $signinDTO->email,
            roles: [
                $this->roleRepository->findByName('USER'),
            ],
        );

        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            $signinDTO->password
        ));

        $this->userRepository->save($user, true);
    }

    public function getUser(): User
    {
        return $this->userRepository
            ->findByUsername(
                $this->security
                    ->getUser()
                    ->getUserIdentifier()
            );
    }
}
