<?php

namespace App\Model;

use App\Database\Repository\GroupRepository;

class User implements UserInterface
{
    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var Group[]
     */
    private $groups = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Group[]
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param Group[] $groups
     */
    public function setGroups(array $groups): void
    {
        $this->groups = $groups;
    }

    public static function assign(array $data): User
    {
        $user = new self();

        $user->setId($data['id'] ?? null);
        $user->setEmail($data['email'] ?? null);
        $user->setPassword($data['password'] ?? null);
        $user->setCreatedAt(isset($data['created_at']) ? new \DateTime($data['created_at']) : null);
        $user->setGroups(
            (new GroupRepository())->getUserGroups($user->getId())
        );

        return $user;
    }

    public function hasPermission(string $permission): bool
    {
        foreach ($this->getGroups() as $group) {
            if ($group->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
