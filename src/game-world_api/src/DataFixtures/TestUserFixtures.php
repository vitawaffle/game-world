<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\{Fixture, FixtureGroupInterface};
use Doctrine\Persistence\ObjectManager;
use App\Entity\{User, Role};

class TestUserFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $roleRepository = $manager->getRepository(Role::class);

        $manager->persist(new User(
            username: 'TestUser1',
            password: 'TestPassword1',
            email: 'test1@email.com',
            roles: [
                $roleRepository->find(1),
            ],
        ));

        $manager->persist(new User(
            username: 'TestUser2',
            password: 'TestPassword2',
            email: 'test2@email.com',
            roles: [
                $roleRepository->find(2),
            ],
        ));

        $manager->persist(new User(
            username: 'TestUser3',
            password: 'TestPassword3',
            email: 'test3@email.com',
            roles: [
                $roleRepository->find(3),
            ],
        ));

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
