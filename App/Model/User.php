<?php

namespace App\Model;

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
    private $userName;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var \DateTime|null
     */
    private $createdAt;

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

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
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

    public static function assign(array $data): User
    {
        $user = new self();

        $user->setId($data['id'] ?? null);
        $user->setEmail($data['email'] ?? null);
        $user->setUserName($data['user_name'] ?? null);
        $user->setPassword($data['password'] ?? null);
        $user->setCreatedAt(isset($data['created_at']) ? new \DateTime($data['created_at']) : null);

        return $user;
    }
}
