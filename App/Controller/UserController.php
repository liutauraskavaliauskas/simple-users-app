<?php

namespace App\Controller;

use App\Model\User;

class UserController extends BaseController
{
    public function create(): void
    {
        $email = $this->getEmail();

        $existingUser = $this->repository->getOneByEmail($email);

        if ($existingUser instanceof User) {
            die ('Such user already exists!');
        }

        $user = $this->repository->createOne($email, password_hash($this->getPassword(), PASSWORD_BCRYPT));

        if (!$user instanceof User) {
            die ('Something went wrong');
        }

        header('Location: index.php');

        exit();
    }
}