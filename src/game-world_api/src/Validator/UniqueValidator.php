<?php

namespace App\Validator;

use Symfony\Component\Validator\{ConstraintValidator, Constraint};
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SqlEntity;

class UniqueValidator extends ConstraintValidator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Unique) {
            throw new UnexpectedTypeException($value, Unique::class);
        }

        if (!is_subclass_of($constraint->entityClass, SqlEntity::class)) {
            throw new UnexpectedTypeException($constraint->entityClass, SqlEntity::class);
        }

        if (null === $value) {
            return;
        }

        $repository = $this->entityManager->getRepository($constraint->entityClass);

        if (count($repository->findBy([$constraint->columnName => $value])) > 0) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
