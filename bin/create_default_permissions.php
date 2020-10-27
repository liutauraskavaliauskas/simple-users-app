<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $connection->exec(
        'INSERT INTO permission (name) 
VALUES ("login"), ("dashboard_index"), ("dashboard_new_user"), ("user_create")
ON DUPLICATE KEY UPDATE name = name'
    );

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
