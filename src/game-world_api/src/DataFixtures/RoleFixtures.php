<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\{Fixture, FixtureGroupInterface};
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;

class RoleFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist(new Role(name: 'USER'));
        $manager->persist(new Role(name: 'MODERATOR'));
        $manager->persist(new Role(name: 'ADMIN'));

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['default'];
    }
}
