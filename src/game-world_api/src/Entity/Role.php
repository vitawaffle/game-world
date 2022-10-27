<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping\{Entity, Column};

#[Entity(repositoryClass: RoleRepository::class)]
class Role extends IntIdEntity
{
    public function __construct(
        #[Column(type: 'text')]
        private string $name,
        ?int $id = null,
    ) {
        parent::__construct($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
