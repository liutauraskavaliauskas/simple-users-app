<?php

namespace App\Database\Repository;

use App\Database\Database;
use App\Model\User;
use PDO;

class UserRepository extends Database
{
    /**
     * @return User[]
     */
    public function getAll(): array
    {
        $connection = $this->getConnection();

        $users = [];

        if ($statement = $connection->prepare('SELECT * FROM user')) {
            $statement->execute();

            $fetchedUsers = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($fetchedUsers as $fetchedUser) {
                $users[] = User::assign($fetchedUser);
            }
        }

        $this->closeConnection();

        return $users;
    }

    public function getOneByEmail(string $email): ?User
    {
        $connection = $this->getConnection();

        $user = null;

        if ($statement = $connection->prepare('SELECT * FROM user WHERE email = :email')) {
            $statement->bindParam('email', $email);

            $statement->execute();

            $fetchedUser = $statement->fetch(PDO::FETCH_ASSOC);

            if (false !== $fetchedUser) {
                $user = User::assign($fetchedUser);
            }
        }

        $this->closeConnection();

        return $user;
    }

    public function createOne(string $email, string $password): ?User
    {
        $connection = $this->getConnection();

        $user = null;

        if ($statement = $connection->prepare('INSERT INTO user (email, password) VALUES (:email, :password)')) {
            $statement->bindParam('email', $email);
            $statement->bindParam('password', $password);

            $statement->execute();

            $user = $this->getOneByEmail($email);
        }

        $this->closeConnection();

        return $user;
    }
}
