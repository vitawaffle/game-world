<?php

namespace App\Unit\Validator;

use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Validator\{UniqueValidator, Unique};
use App\Repository\UserRepository;
use App\Entity\User;

class UniqueValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): UniqueValidator
    {
        $repository = $this->createMock(UserRepository::class);

        $repository->expects($this->any())
            ->method('findBy')
            ->willReturnCallback(fn ($criteria) => match ($criteria) {
                ['email' => 'test1@email.com'] => [new User(
                    username: 'TestUser1',
                    password: 'TestPassword1',
                    email: 'test1@email.com',
                )],
                default => []
            });

        $entityManager = $this->createMock(EntityManagerInterface::class);

        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($repository);

        return new UniqueValidator($entityManager);
    }

    public function test_InvalidConstraintType_ShouldThrowsUnexpectedTypeException(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->validator->validate('test@email.com', new class extends Constraint {
        });
    }

    public function test_Null_ShouldBeNoViolation(): void
    {
        $this->validator->validate(null, new Unique(User::class, 'email'));

        $this->assertNoViolation();
    }

    public function test_UniqueValue_ShouldBeNoViolation(): void
    {
        $this->validator->validate('test@email.com', new Unique(User::class, 'email'));

        $this->assertNoViolation();
    }

    public function test_NotUniqueValue_ShouldRaised(): void
    {
        $this->validator->validate('test1@email.com', new Unique(User::class, 'email'));

        $this->buildViolation('The value {{ string }} must be unique.')
            ->setParameter('{{ string }}', 'test1@email.com')
            ->assertRaised();
    }
}
