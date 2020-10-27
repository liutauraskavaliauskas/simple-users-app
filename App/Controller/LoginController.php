<?php

namespace App\Controller;

use App\Model\User;

class LoginController extends BaseController
{
    public function authenticate(): void
    {
        session_start();

        $user = $this->repository
            ->getOneByEmail(
                $this->getEmail()
            );

        if (!$user instanceof User) {
            die ('Incorrect email!');
        }

        if (true !== password_verify($this->getPassword(), $user->getPassword())) {
            die ('Incorrect password!');
        }

        session_regenerate_id(true);

        $_SESSION['currentUser'] = $user;

        $dashboardController = new DashboardController();

        $dashboardController->index();
    }
}