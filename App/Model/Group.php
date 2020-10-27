<?php

namespace App\Model;

class Group
{
    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var Permission[]
     */
    private $permissions = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function addPermission(string $key, Permission $permission): void
    {
        $this->permissions[$key] = $permission;
    }

    public function hasPermission(string $permission): bool
    {
        return isset($this->permissions[$permission]);
    }

    public static function assign(array $data): Group
    {
        $group = new self();

        $group->setId($data['id'] ?? null);
        $group->setName($data['name'] ?? null);

        return $group;
    }
}
