<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $connection->exec(
        'CREATE TABLE IF NOT EXISTS user (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
email varchar(255) NOT NULL UNIQUE ,
password varchar(255) NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
    );

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
