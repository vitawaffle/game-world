<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\{MappedSuperclass, Entity, Id, GeneratedValue, Column};

#[MappedSuperclass]
abstract class IntIdEntity extends SqlEntity
{
    public function __construct(
        #[Id, GeneratedValue, Column(type: 'bigint')]
        protected ?int $id = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
