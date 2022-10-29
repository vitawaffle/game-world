<?php

namespace App\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\{User, Role};

class UserTest extends TestCase
{
    public function testConstructorShouldInstantiate(): void
    {
        self::assertNotNull(new User(
            username: 'TestUser1',
            password: 'TestPassword1',
            roles: new ArrayCollection([
                new Role(name: 'TEST_ROLE_1', id: 1),
            ]),
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
            ))->setPassword($password)
                ->getPassword(),
        );
    }

    public function testGetRolesShouldReturn(): void
    {
        $roles = new ArrayCollection([
            new Role(name: 'TEST_ROLE_1', id: 1),
        ]);

        self::assertSame(
            $roles,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                roles: $roles,
            ))->getRoles(),
        );
    }

    public function testSetRolesShouldSet(): void
    {
        $roles = new ArrayCollection([
            new Role(name: 'NEW_ROLE_1', id: 1),
        ]);

        self::assertSame(
            $roles,
            (new User(
                username: 'TestUser1',
                password: 'TestPassword1',
                roles: new ArrayCollection([
                    new Role(name: 'TEST_ROLE_1', id: 1),
                ]),
            ))->setRoles($roles)
                ->getRoles(),
        );
    }
}
