<?php

namespace App\Integration\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Repository\RoleRepository;
use App\Entity\Role;

class RoleRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;
    private RoleRepository $repository;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()
            ->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $this->entityManager
            ->getRepository(Role::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testFindExistingIdShouldReturnNotNull(): void
    {
        self::assertNotNull($this->repository->find(1));
    }

    public function testFindNotExistingIdShouldReturnNull(): void
    {
        self::assertNull($this->repository->find(0));
    }

    public function testFindOneByExistingCriteriaShouldReturnNotNull(): void
    {
        self::assertNotNull($this->repository->findOneBy(['name' => 'TEST_ROLE_1']));
    }

    public function testFindOneByNotExistingCriteriaShouldReturnNull(): void
    {
        self::assertNull($this->repository->findOneBy(['name' => '']));
    }

    public function testFindAllShouldReturnNotEmpty(): void
    {
        self::assertNotEmpty($this->repository->findAll());
    }

    public function testFindByExistingCriteriaShouldReturnNotEmpty(): void
    {
        self::assertNotEmpty($this->repository->findBy(['name' => 'TEST_ROLE_1']));
    }

    public function testFindByNotExistingCriteriaShouldReturnEmpty(): void
    {
        self::assertEmpty($this->repository->findBy(['name' => '']));
    }

    public function testFindByNameExistingNameShouldReturnNotNull(): void
    {
        self::assertNotNull($this->repository->findByName('TEST_ROLE_1'));
    }

    public function testFindByNameNotExistingNameShouldReturnNull(): void
    {
        self::assertNull($this->repository->findByName(''));
    }

    public function testSaveValidEntityShouldSave(): void
    {
        $this->repository->save(new Role(name: 'TEST_ROLE'), true);

        self::assertNotNull($this->repository->findByName('TEST_ROLE'));
    }

    public function testRemoveShouldRemove(): void
    {
        $this->repository->remove($this->repository->find(1), true);

        self::assertNull($this->repository->find(1));
    }
}
