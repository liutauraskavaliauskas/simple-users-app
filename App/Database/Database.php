<?php

namespace App\Database;

use PDO;

class Database
{
    public const HOST = 'localhost';
    public const USERNAME = 'root';
    public const PASSWORD = 'liutauras';
    public const DB_NAME = 'simple_users_database';

    /**
     * @var PDO|null
     */
    private $pdo;

    private function establishConnection(): PDO
    {
        $this->pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s',
                self::HOST,
                self::DB_NAME
            ),
            self::USERNAME,
            self::PASSWORD
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->pdo;
    }

    public function getConnection(): PDO
    {
        if (!$this->pdo instanceof PDO) {
            $this->establishConnection();
        }

        return $this->pdo;
    }

    public function closeConnection(): void
    {
        // In order to close connection an object must be destroyed
        $this->pdo = null;
    }
}