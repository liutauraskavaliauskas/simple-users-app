<?php

require_once '../App/autoload.php';

use App\Database\Database;

try {
    $connection = new PDO(
        sprintf('mysql:host=%s', Database::HOST),
        Database::USERNAME,
        Database::PASSWORD
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connection->exec(sprintf('CREATE DATABASE IF NOT EXISTS %s', Database::DB_NAME));
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
