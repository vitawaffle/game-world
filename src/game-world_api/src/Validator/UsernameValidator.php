<?php

namespace App\Validator;

use Symfony\Component\Validator\{ConstraintValidator, Constraint};
use Symfony\Component\Validator\Exception\{UnexpectedTypeException, UnexpectedValueException};

class UsernameValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Username) {
            throw new UnexpectedTypeException($constraint, Username::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{1,31}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
