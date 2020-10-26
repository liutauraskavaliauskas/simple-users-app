<?php

namespace App\Database\Repository;

use App\Database\Database;
use App\Model\User;

class UserRepository extends Database
{
    public function getOneByUserNameAndPassword(string $userName, string $password): ?User
    {
        $connection = $this->getConnection();

        $user = null;

        if ($statement = $connection->prepare('SELECT * FROM users')) {
            $statement->bindParam('username', $userName);
            $statement->bindParam('password', $password);

            $statement->execute();

            $user = User::assign($statement->fetch());
        }

        $this->closeConnection();

        return $user;
    }
}
