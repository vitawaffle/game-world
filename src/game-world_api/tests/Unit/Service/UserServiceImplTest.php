<?php

namespace App\Unit\Service;

use PHPUnit\Framework\TestCase;
use App\Service\{UserServiceImpl, AuthServiceImpl};
use App\Repository\UserRepository;
use App\Entity\User;
use App\DTO\UserDTO;

class UserServiceImplTest extends TestCase
{
    private UserServiceImpl $service;
    private User $updatedUser;

    protected function setUp(): void
    {
        $userRepository = $this->createMock(UserRepository::class);

        $userRepository->expects($this->any())
            ->method('save')
            ->willReturnCallback(function ($user) {
                $this->updatedUser = new User(
                    username: $user->getUsername(),
                    password: $user->getPassword(),
                    email: $user->getEmail(),
                    id: $user->getId(),
                );
            });

        $authService = $this->createMock(AuthServiceImpl::class);

        $authService->expects($this->any())
            ->method('getUser')
            ->willReturn(new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
                id: 1,
            ));

        $this->service = new UserServiceImpl($userRepository, $authService);
    }

    public function testUpdateUserShouldUpdate(): void
    {
        $userDTO = new UserDTO(
            username: 'NewUsername',
        );

        $this->service->updateUser($userDTO);

        self::assertEquals(
            $userDTO->username,
            $this->updatedUser->getUsername(),
        );
    }
}
