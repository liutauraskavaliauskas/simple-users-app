<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $statement = $connection->query('SELECT * FROM system_group');
    $groups = array_column($statement->fetchAll(), 'id');

    if (!empty($groups)) {
        $statement = $connection->query("SELECT id FROM user WHERE email = 'liutauras@liutauras.com'");
        $userId = $statement->fetch()['id'] ?? null;

        if (!empty($userId)) {
            foreach ($groups as $group) {
                $statement = $connection->prepare(
                    'INSERT IGNORE INTO user_group (user_id, group_id) VALUES (:userId, :groupId)'
                );

                $statement->bindParam('userId', $userId);
                $statement->bindParam('groupId', $group);

                $statement->execute();
            }
        }
    }

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
