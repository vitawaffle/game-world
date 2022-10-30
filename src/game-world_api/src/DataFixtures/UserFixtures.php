<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\{Fixture, FixtureGroupInterface};
use Doctrine\Persistence\ObjectManager;
use App\Entity\{User, Role};
use Doctrine\Common\Collections\ArrayCollection;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $roleRepository = $manager->getRepository(Role::class);

        $manager->persist(new User(
            username: 'TestUser1',
            password: 'TestPassword1',
            roles: new ArrayCollection([
                $roleRepository->find(1),
            ]),
        ));

        $manager->persist(new User(
            username: 'TestUser2',
            password: 'TestPassword2',
            roles: new ArrayCollection([
                $roleRepository->find(2),
            ]),
        ));

        $manager->persist(new User(
            username: 'TestUser3',
            password: 'TestPassword3',
            roles: new ArrayCollection([
                $roleRepository->find(3),
            ]),
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
