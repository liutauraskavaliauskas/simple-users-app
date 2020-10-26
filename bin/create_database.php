<?php

require_once '../App/autoload.php';

use App\Database\Database;

try {
    $connection = new PDO(
        sprintf('mysql:host=%s', Database::HOST),
        Database::USERNAME,
        Database::PASSWORD
    );

    $connection->exec(sprintf('CREATE DATABASE IF NOT EXISTS %s', Database::DB_NAME));

    // In order to close connection an object must be destroyed
    $connection = null;
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
