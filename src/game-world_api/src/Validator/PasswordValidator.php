<?php

namespace App\Validator;

use Symfony\Component\Validator\{ConstraintValidator, Constraint};
use Symfony\Component\Validator\Exception\{UnexpectedTypeException, UnexpectedValueException};

class PasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Password) {
            throw new UnexpectedTypeException($constraint, Password::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!($this->isHasBigLetter($value)
            && $this->isHasNumber($value)
            && $this->isHasSmallLetter($value)
            && $this->isGreaterThanMinimalLength($value)
        )) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }

    private function isHasBigLetter(string $value): bool
    {
        return preg_match('/[A-ZА-Я]/', $value);
    }

    private function isHasNumber(string $value): bool
    {
        return preg_match('/[0-9]/', $value);
    }

    private function isHasSmallLetter(string $value): bool
    {
        return preg_match('/[a-zа-я]/', $value);
    }

    private function isGreaterThanMinimalLength(string $value): bool
    {
        return strlen($value) >= 8;
    }
}
