<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Entity\Role;
use Doctrine\ORM\Mapping\{
    Entity,
    Table,
    Column,
    ManyToMany,
    JoinTable,
    JoinColumn,
    InverseJoinColumn,
};
use Doctrine\Common\Collections\ArrayCollection;

#[Entity(repositoryClass: UserRepository::class), Table(name: 'users')]
class User extends IntIdEntity
{
    /**
     * @param ArrayCollection<Role> $roles
     */
    public function __construct(
        #[Column(type: 'text')]
        private string $username,
        #[Column(type: 'text')]
        private string $password,
        #[ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
        #[JoinTable(name: 'users_roles')]
        #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
        #[InverseJoinColumn(name : 'role_id', referencedColumnName: 'id')]
        private $roles = new ArrayCollection(),
        ?int $id = null,
    ) {
        parent::__construct($id);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return ArrayCollection<Role>
     */
    public function getRoles(): ArrayCollection
    {
        return $this->roles;
    }

    /**
     * @param ArrayCollection<Role> $roles
     */
    public function setRoles(ArrayCollection $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
