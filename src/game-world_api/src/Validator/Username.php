<?php

namespace App\Validator;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Attribute;

#[Attribute]
class Username extends AppConstraint
{
    #[HasNamedArguments]
    public function __construct(
        public readonly string $message = 'Username {{ string }} has invalid format: the username must contain latin '
            . 'letters, can contain numbers, underscores and be between 2 and 32 characters long.'
    ) {
        parent::__construct();
    }
}
