<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping\{Entity, Table, Column, ManyToMany};
use Doctrine\Common\Collections\ArrayCollection;

#[Entity(repositoryClass: RoleRepository::class), Table(name: 'roles')]
class Role extends IntIdEntity
{
    /**
     * @param ArrayCollection<User> $users
     */
    public function __construct(
        #[Column(type: 'text')]
        private string $name,
        #[ManyToMany(targetEntity: User::class, mappedBy: 'roles')]
        private $users = new ArrayCollection(),
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

    /**
     * @return ArrayCollection<User>
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection<User> $users
     */
    public function setUsers(ArrayCollection $users): self
    {
        $this->users = $users;

        return $this;
    }
}
