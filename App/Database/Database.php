<?php

namespace App\Database;

use PDO;

class Database
{
    public const HOST = 'localhost';
    public const USERNAME = 'root';
    public const PASSWORD = 'liutauras';
    public const DB_NAME = 'simple_users_database';

    public function getConnection(): PDO
    {
        return new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s',
                self::HOST,
                self::DB_NAME
            ),
            self::USERNAME,
            self::PASSWORD
        );
    }
}