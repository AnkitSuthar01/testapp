<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $phone_number = null;

    #[ORM\Column(length: 5)]
    private ?string $gender = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?RoleUser $users = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?RoleUser $roleUsers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getUsers(): ?RoleUser
    {
        return $this->users;
    }

    public function setUsers(RoleUser $users): self
    {
        // set the owning side of the relation if necessary
        if ($users->getUser() !== $this) {
            $users->setUser($this);
        }

        $this->users = $users;

        return $this;
    }

    public function getRoleUsers(): ?RoleUser
    {
        return $this->roleUsers;
    }

    public function setRoleUsers(RoleUser $roleUsers): self
    {
        // set the owning side of the relation if necessary
        if ($roleUsers->getUser() !== $this) {
            $roleUsers->setUser($this);
        }

        $this->roleUsers = $roleUsers;

        return $this;
    }
}
