<?php

namespace App\Validator;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Attribute;

#[Attribute]
class Password extends AppConstraint
{
    #[HasNamedArguments]
    public function __construct(
        public readonly string $message = 'Password {{ string }} has invalid format: '
            . 'the password must contain uppercase and lowercase letters, numbers and be at least 8 characters long.',
    ) {
        parent::__construct();
    }
}
