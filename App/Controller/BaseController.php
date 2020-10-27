<?php

namespace App\Controller;

use App\Database\Repository\UserRepository;

class BaseController
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function getEmail(): ?string
    {
        return $_POST['email'] ?? null;
    }

    protected function getPassword(): ?string
    {
        return $_POST['password'] ?? null;
    }
}