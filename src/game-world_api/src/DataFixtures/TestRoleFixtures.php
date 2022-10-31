<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\{Fixture, FixtureGroupInterface};
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;

class TestRoleFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist(new Role(name: 'TEST_ROLE_1'));
        $manager->persist(new Role(name: 'TEST_ROLE_2'));
        $manager->persist(new Role(name: 'TEST_ROLE_3'));

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['test'];
    }
}
