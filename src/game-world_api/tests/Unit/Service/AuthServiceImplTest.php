<?php

namespace App\Unit\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\{UserRepository, RoleRepository};
use App\Service\AuthServiceImpl;
use App\Entity\{User, Role};
use App\DTO\SigninDTO;

class AuthServiceImplTest extends TestCase
{
    private AuthServiceImpl $service;
    private User $signedInUser;

    protected function setUp(): void
    {
        $passwordHasher = $this->createMock(UserPasswordHasherInterface::class);

        $passwordHasher->expects($this->any())
            ->method('hashPassword')
            ->willReturnCallback(fn ($user, $password) => $password . '_HASHED');

        $security = $this->createMock(Security::class);

        $security->expects($this->any())
            ->method('getUser')
            ->willReturn(new class () implements UserInterface {
                public function getRoles(): array
                {
                    return [];
                }

                public function eraseCredentials(): void
                {
                }

                public function getUserIdentifier(): string
                {
                    return 'TestUser1';
                }
            });

        $userRepository = $this->createMock(UserRepository::class);

        $userRepository->expects($this->any())
            ->method('save')
            ->willReturnCallback(function ($user, $isFlush) {
                $this->signedInUser = new User(
                    username: $user->getUsername(),
                    password: $user->getPassword(),
                    email: $user->getEmail(),
                    roles: $user->getRoleObjects(),
                    id: 1,
                );
            });

        $userRepository->expects($this->any())
            ->method('findByUsername')
            ->willReturnCallback(fn ($username) => match ($username) {
                'TestUser1' => new User(
                    username: 'TestUser1',
                    password: 'TestPassword1',
                    email: 'test1@email.com',
                    id: 1,
                ),
                default => null,
            });

        $roleRepository = $this->createMock(RoleRepository::class);

        $roleRepository->expects($this->any())
            ->method('findByName')
            ->willReturnCallback(fn ($name) => match ($name) {
                'USER' => new Role(
                    name: 'USER',
                    id: 1,
                ),
                default => null,
            });

        $this->service = new AuthServiceImpl($passwordHasher, $security, $userRepository, $roleRepository);
    }

    public function testSigninShouldCreteNewUser(): void
    {
        $signinDTO = new SigninDTO(
            username: 'TestUser',
            password: 'TestPassword',
            email: 'test1@email.com',
        );

        $this->service->signin($signinDTO);

        self::assertEquals(
            $signinDTO->username,
            $this->signedInUser->getUsername(),
        );
        self::assertEquals(
            $signinDTO->password . '_HASHED',
            $this->signedInUser->getPassword(),
        );
        self::assertEquals(
            $signinDTO->email,
            $this->signedInUser->getEmail(),
        );
        self::assertEquals(
            [new Role(
                name: 'USER',
                id: 1,
            )],
            $this->signedInUser->getRoleObjects(),
        );
    }

    public function testGetUserShouldReturnUser(): void
    {
        self::assertNotNull($this->service->getUser());
    }
}
