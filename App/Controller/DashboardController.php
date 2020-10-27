<?php

namespace App\Controller;

use App\Database\Repository\UserRepository;

class DashboardController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): void
    {
        $users = $this->userRepository->getAll();

        include 'Resources/views/Dashboard/index.php';
    }
}