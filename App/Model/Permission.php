<?php

namespace App\Model;

class Permission
{
    /**
     * @var string|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

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

    public static function assign(array $data): Permission
    {
        $permission = new self();

        $permission->setId($data['id'] ?? null);
        $permission->setName($data['name'] ?? null);

        return $permission;
    }
}
