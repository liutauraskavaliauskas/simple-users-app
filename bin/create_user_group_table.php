<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $connection->exec(
        'CREATE TABLE IF NOT EXISTS user_group (
user_id INT UNSIGNED NOT NULL,
group_id INT UNSIGNED NOT NULL,
FOREIGN KEY (user_id) REFERENCES user(id),
FOREIGN KEY (group_id) REFERENCES system_group(id),
PRIMARY KEY (user_id, group_id)                                   
) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
    );

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
