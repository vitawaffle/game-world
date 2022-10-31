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
use Doctrine\Common\Collections\{Collection, ArrayCollection};
use Symfony\Component\Security\Core\User\{
    UserInterface,
    PasswordAuthenticatedUserInterface,
};

#[Entity(repositoryClass: UserRepository::class), Table(name: 'users')]
class User extends IntIdEntity
    implements UserInterface, PasswordAuthenticatedUserInterface {
    /** @var Collection<Role> */
    #[
        ManyToMany(targetEntity: Role::class, inversedBy: 'users'),
        JoinTable(name: 'users_roles'),
        JoinColumn(name: 'user_id', referencedColumnName: 'id'),
        InverseJoinColumn(name : 'role_id', referencedColumnName: 'id'),
    ]
    private Collection $roles;

    /**
     * @param string $username
     * @param string $password
     * @param Role[] $roles
     * @param int|null $id
     */
    public function __construct(
        #[Column(type: 'text')]
        private string $username,
        #[Column(type: 'text')]
        private string $password,
        array $roles = [],
        ?int $id = null,
    ) {
        parent::__construct($id);

        $this->roles = new ArrayCollection($roles);
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
     * @return string[]
     */
    public function getRoles(): array
    {
        return array_map(fn ($role) => $role->getName(), $this->roles->toArray());
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
