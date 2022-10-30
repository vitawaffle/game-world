<?php

namespace App\Integration\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use App\Entity\User;

class UserRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;
    private UserRepository $repository;

    protected function setUp(): void
    {
        $this->entityManager = self::bootKernel()
            ->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repository = $this->entityManager
            ->getRepository(User::class);
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
        self::assertNotNull($this->repository->findOneBy(['username' => 'TestUser1']));
    }

    public function testFindOneByNotExistingCriteriaShouldReturnNull(): void
    {
        self::assertNull($this->repository->findOneBy(['username' => '']));
    }

    public function testFindAllShouldReturnNotEmpty(): void
    {
        self::assertNotEmpty($this->repository->findAll());
    }

    public function testFindByExistingCriteriaShouldReturnNotEmpty(): void
    {
        self::assertNotEmpty($this->repository->findBy(['username' => 'TestUser1']));
    }

    public function testFindByNotExistingCriteriaShouldReturnEmpty(): void
    {
        self::assertEmpty($this->repository->findBy(['username' => '']));
    }

    public function testFindByUsernameExistingUsernameShouldReturnNotNull(): void
    {
        self::assertNotNull($this->repository->findByUsername('TestUser1'));
    }

    public function testFindByUsernameNotExistingUsernameShouldReturnNull(): void
    {
        self::assertNull($this->repository->findByUsername(''));
    }

    public function testSaveValidEntityShouldSave(): void
    {
        $this->repository->save(new User(
            username: 'TestUser',
            password: 'TestPassword',
        ), true);

        self::assertNotNull($this->repository->findByUsername('TestUser'));
    }

    public function testRemoveShouldRemove(): void
    {
        $this->repository->remove($this->repository->find(1), true);

        self::assertNull($this->repository->find(1));
    }
}
