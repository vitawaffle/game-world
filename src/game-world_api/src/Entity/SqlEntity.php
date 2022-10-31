<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
abstract class SqlEntity
{
    public function __toString(): string
    {
        return json_encode($this);
    }
}
