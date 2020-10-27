<?php

namespace App\Database\Repository;

use App\Database\Database;
use App\Model\User;
use PDO;

class UserRepository extends Database
{
    public function getOneByEmailAndPassword(string $email, string $password): ?User
    {
        $connection = $this->getConnection();

        $user = null;

        if ($statement = $connection->prepare('SELECT * FROM users WHERE email = :email')) {
            $statement->bindParam('email', $email);

            $statement->execute();

            $fetchedUser = $statement->fetch(PDO::FETCH_ASSOC);

            if (false !== $fetchedUser) {
                $validPassword = password_verify($password, $fetchedUser['password']);

                if (true === $validPassword) {
                    $user = User::assign($fetchedUser);
                }
            }
        }


        $this->closeConnection();

        return $user;
    }

    /**
     * @return User[]
     */
    public function getAll(): array
    {
        $connection = $this->getConnection();

        $users = [];

        if ($statement = $connection->prepare('SELECT * FROM users')) {
            $statement->execute();

            $fetchedUsers = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($fetchedUsers as $fetchedUser) {
                $users[] = User::assign($fetchedUser);
            }
        }

        $this->closeConnection();

        return $users;
    }
}
