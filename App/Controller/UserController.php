<?php

namespace App\Controller;

use App\Auth\Authorization;
use App\Database\Repository\GroupRepository;
use App\Model\User;

class UserController extends BaseController
{
    public function create(): void
    {
        Authorization::canUserAccess('user_create');

        $email = $this->getEmail();

        $existingUser = $this->repository->getOneByEmail($email);

        if ($existingUser instanceof User) {
            die ('Such user already exists!');
        }

        $user = $this->repository->createOne($email, password_hash($this->getPassword(), PASSWORD_BCRYPT));

        if (!$user instanceof User) {
            die ('Something went wrong');
        }

        $this->addUserToGroup($user->getId());

        header('Location: index.php');

        exit();
    }

    private function addUserToGroup(int $userId): void
    {
        $groupId = $_POST['group'] ?? null;

        if (!empty($groupId)) {
            (new GroupRepository())->addUserToGroup($userId, $groupId);
        }
    }
}