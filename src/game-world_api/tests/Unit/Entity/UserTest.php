<?php

namespace App\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\{User, Role};
use \DateTimeImmutable;

class UserTest extends TestCase
{
    public function testConstructorShouldInstantiate(): void
    {
        self::assertNotNull(new User(
            username: 'TestUser1',
            password: 'TestPassword1',
            email: 'test1@email.com',
            roles: [
                new Role(name: 'TEST_ROLE_1', id: 1),
            ],
        ));
    }

    public function testGetUsernameShouldReturn(): void
    {
        $username = 'TestUser1';

        self::assertSame(
            $username,
            (new User(
                username: $username,
                password: 'TestPassword1',
                email: 'test1@email.com',
            ))->getUsername(),
        );
    }

    public function testSetUsernameShouldSet(): void
    {
        $username = 'NewUser';

        self::assertSame(
            $username,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
            ))->setUsername($username)
                ->getUsername(),
        );
    }

    public function testGetPasswordShouldReturn(): void
    {
        $password = 'TestPassword1';

        self::assertSame(
            $password,
            (new User(
                username: 'TestUser1',
                password: $password,
                email: 'test1@email.com',
            ))->getPassword(),
        );
    }

    public function testSetPasswordShouldSet(): void
    {
        $password = 'NewPassword1';

        self::assertSame(
            $password,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
            ))->setPassword($password)
                ->getPassword(),
        );
    }

    public function testGetEmailShouldReturn(): void
    {
        $email = 'test1@email.com';

        self::assertSame(
            $email,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: $email,
            ))->getEmail(),
        );
    }

    public function testSetEmailShouldSet(): void
    {
        $email = 'new_test1@email.com';

        self::assertSame(
            $email,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
            ))->setEmail($email)
                ->getEmail(),
        );
    }

    public function testGetEmailVerifiedAtShouldReturn(): void
    {
        $emailVerifiedAt = new DateTimeImmutable();

        self::assertSame(
            $emailVerifiedAt,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
                emailVerifiedAt: $emailVerifiedAt,
            ))->getEmailVerifiedAt(),
        );
    }

    public function testSetEmailVerifiedAtShouldSet(): void
    {
        $emailVerifiedAt = new DateTimeImmutable('2020-10-10 00:00');

        self::assertSame(
            $emailVerifiedAt,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
                emailVerifiedAt: new DateTimeImmutable(),
            ))->setEmailVerifiedAt($emailVerifiedAt)
                ->getEmailVerifiedAt(),
        );
    }

    public function testGetRolesShouldReturn(): void
    {
        $roles = [
            new Role(name: 'TEST_ROLE_1', id: 1),
        ];

        self::assertSame(
            $roles,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
                roles: $roles,
            ))->getRoleObjects(),
        );
    }

    public function testSetRolesShouldSet(): void
    {
        $roles = [
            new Role(name: 'NEW_ROLE_1', id: 1),
        ];

        self::assertSame(
            $roles,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                email: 'test1@email.com',
                roles: [
                    new Role(name: 'TEST_ROLE_1', id: 1),
                ],
            ))->setRoles($roles)
                ->getRoleObjects(),
        );
    }
}
