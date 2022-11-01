<?php

namespace App\Unit\Validator;

use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Exception\{UnexpectedValueException, UnexpectedTypeException};
use Symfony\Component\Validator\Constraint;
use App\Validator\{Username, UsernameValidator};

class UsernameValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): UsernameValidator
    {
        return new UsernameValidator();
    }

    public function testInvalidConstraintTypeShouldThrowsUnexpectedTypeException(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->validator->validate('Test_User_1', new class extends Constraint {
        });
    }

    public function testNullShouldBeNoViolation(): void
    {
        $this->validator->validate(null, new Username());

        $this->assertNoViolation();
    }

    public function testBlankShouldBeNoViolation(): void
    {
        $this->validator->validate('', new Username());

        $this->assertNoViolation();
    }

    public function testInvalidValueTypeShouldThrowsUnexpectedValueException(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(12345678, new Username());
    }

    public function testValidShouldBeNoViolation(): void
    {
        $this->validator->validate('Test_User_1', new Username());

        $this->assertNoViolation();
    }

    public function testHasNoLatinLetterShouldRaised(): void
    {
        $noLatinLetterUsername = '123_456';

        $this->validator->validate($noLatinLetterUsername, new Username());

        $this->assertRaised($noLatinLetterUsername);
    }

    private function assertRaised(string $value): void
    {
        $this->buildViolation(
            'Username {{ string }} has invalid format: the username must contain latin '
                . 'letters, can contain numbers, underscores and be between 2 and 32 characters long.'
        )->setParameter('{{ string }}', $value)
            ->assertRaised();
    }

    public function testNotStartsWithLatinLetterShouldRaised(): void
    {
        $notStartsWithLatinLetterUsername = '1_Test_User';

        $this->validator->validate($notStartsWithLatinLetterUsername, new Username());

        $this->assertRaised($notStartsWithLatinLetterUsername);
    }

    public function testShorterThan2SymbolsShouldRaised(): void
    {
        $shorterThan2SymbolsUsername = 'U';

        $this->validator->validate($shorterThan2SymbolsUsername, new Username());

        $this->assertRaised($shorterThan2SymbolsUsername);
    }

    public function testLongerThan32SymbolsShouldRaised(): void
    {
        $longerThan32SymbolsUsername = 'UsernameUsernameUsernameUsername_';

        $this->validator->validate($longerThan32SymbolsUsername, new Username());

        $this->assertRaised($longerThan32SymbolsUsername);
    }

    public function testInvalidCharacterShouldRaised(): void
    {
        $invalidCharacterUsername = 'UserФ';

        $this->validator->validate($invalidCharacterUsername, new Username());

        $this->assertRaised($invalidCharacterUsername);
    }
}
