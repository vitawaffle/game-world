<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

abstract class AppConstraint extends Constraint
{
    /**
     * @param mixed $options
     * @param string[] $groups
     * @param mixed $payload
     */
    public function __construct(mixed $options = null, array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
