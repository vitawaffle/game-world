<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping\{Entity, Table, Column, ManyToMany};
use Doctrine\Common\Collections\{Collection, ArrayCollection};
use \JsonSerializable;

#[Entity(repositoryClass: RoleRepository::class), Table(name: 'roles')]
class Role extends IntIdEntity implements JsonSerializable
{
    /** @var Collection<User> */
    #[ManyToMany(targetEntity: User::class, mappedBy: 'roles')]
    private Collection $users;

    /**
     * @param string $name
     * @param User[] $users
     * @param int|null $id
     */
    public function __construct(
        #[Column(type: 'text')]
        private string $name,
        array $users = [],
        ?int $id = null,
    ) {
        parent::__construct($id);

        $this->users = new ArrayCollection($users);
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
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users->toArray();
    }

    /**
     * @param User[] $users
     * @return Role
     */
    public function setUsers(array $users): self
    {
        $this->users = new ArrayCollection($users);

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
