<?php

namespace App\Controller;

use App\Database\Repository\UserRepository;
use App\Model\User;

class LoginController
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function authenticate(): void
    {
        $user = $this->repository
            ->getOneByUserNameAndPassword(
                $this->getUserName(),
                $this->getPassword()
            );

        if (!$user instanceof User) {
             // TODO: Add redirect
        }

        // TODO: add error messages on fail
    }

    private function getUserName(): ?string
    {
        return $_POST['username'] ?? null;
    }

    private function getPassword(): ?string
    {
        return $_POST['password'] ?? null;
    }
}