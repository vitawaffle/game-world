<?php

namespace App\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Role;

class RoleTest extends TestCase
{
    public function testConstructorShouldInstantiate(): void
    {
        self::assertNotNull(new Role(name: 'TEST_ROLE', id: 1));
    }

    public function testGetNameShouldReturn(): void
    {
        $name = 'TEST_ROLE';

        self::assertSame(
            $name,
            (new Role(name: $name))->getName(),
        );
    }

    public function testSetNameShouldSet(): void
    {
        $newName = 'NEW_ROLE';

        self::assertSame(
            $newName,
            (new Role(name: 'TEST_ROLE'))->setName($newName)
                ->getName(),
        );
    }
}
