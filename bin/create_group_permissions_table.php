<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $connection->exec(
        'CREATE TABLE IF NOT EXISTS group_permission (
group_id INT UNSIGNED NOT NULL,
permission_id INT UNSIGNED NOT NULL,
FOREIGN KEY (group_id) REFERENCES system_group(id),
FOREIGN KEY (permission_id) REFERENCES permission(id),
PRIMARY KEY (group_id, permission_id)                                       
) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
    );

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
