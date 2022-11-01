<?php

namespace App\Validator;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Attribute;

#[Attribute]
class Unique extends AppConstraint
{
    #[HasNamedArguments]
    public function __construct(
        public readonly string $entityClass,
        public readonly string $columnName,
        public readonly string $message = 'The value {{ string }} must be unique.',
    ) {
        parent::__construct();
    }
}
