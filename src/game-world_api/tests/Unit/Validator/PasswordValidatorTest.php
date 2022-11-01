<?php

namespace App\Unit\Validator;

use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Exception\{UnexpectedValueException, UnexpectedTypeException};
use Symfony\Component\Validator\Constraint;
use App\Validator\{Password, PasswordValidator};

class PasswordValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): PasswordValidator
    {
        return new PasswordValidator();
    }

    public function testInvalidConstraintTypeShouldThrowsUnexpectedTypeException(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->validator->validate('Secret12', new class extends Constraint {
        });
    }

    public function testNullShouldBeNoViolation(): void
    {
        $this->validator->validate(null, new Password());

        $this->assertNoViolation();
    }

    public function testBlankShouldBeNoViolation(): void
    {
        $this->validator->validate('', new Password());

        $this->assertNoViolation();
    }

    public function testInvalidValueTypeShouldThrowsUnexpectedValueException(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(12345678, new Password());
    }

    public function testValidShouldBeNoViolation(): void
    {
        $this->validator->validate('Secret12', new Password());

        $this->assertNoViolation();
    }

    public function testHasNoBigLetterShouldRaised(): void
    {
        $noBigLetterPassword = 'secret12';

        $this->validator->validate($noBigLetterPassword, new Password());

        $this->assertRaised($noBigLetterPassword);
    }

    private function assertRaised(string $value): void
    {
        $this->buildViolation(
            'Password {{ string }} has invalid format: the password must '
                . 'contain uppercase and lowercase letters, numbers and be at least 8 characters long.'
        )->setParameter('{{ string }}', $value)
            ->assertRaised();
    }

    public function testHasNoNumberShouldRaised(): void
    {
        $noNumberPassword = 'Secrettt';

        $this->validator->validate($noNumberPassword, new Password());

        $this->assertRaised($noNumberPassword);
    }

    public function testHasNoSmallLetterShouldRaised(): void
    {
        $noSmallLetterPassword = 'SECRET12';

        $this->validator->validate($noSmallLetterPassword, new Password());

        $this->assertRaised($noSmallLetterPassword);
    }

    public function testLessThanMinimalLengthPasswordShouldRaised(): void
    {
        $lessThanMinimalLengthPassword = 'Secret1';

        $this->validator->validate($lessThanMinimalLengthPassword, new Password());

        $this->assertRaised($lessThanMinimalLengthPassword);
    }
}
