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
use Symfony\Component\Security\Core\User\{
    UserInterface,
    PasswordAuthenticatedUserInterface,
};

#[Entity(repositoryClass: UserRepository::class), Table(name: 'users')]
class User extends IntIdEntity
    implements UserInterface, PasswordAuthenticatedUserInterface {
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
     * @return Role[]
     */
    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

    /**
     * @param Role[] $roles
     */
    public function setRoles(array $roles): self
    {
        $this->roles = new ArrayCollection($roles);

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }
}
