<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $connection->exec(
        'INSERT INTO system_group (name) 
VALUES ("user"), ("admin")
ON DUPLICATE KEY UPDATE name = name'
    );

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
