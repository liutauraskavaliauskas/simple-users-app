<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    $statement = $connection->query('SELECT * FROM permission');
    $adminPermissions = array_column($statement->fetchAll(), 'id');

    if (!empty($adminPermissions)) {
        $statement = $connection->query("SELECT id FROM system_group WHERE name = 'admin'");
        $adminGroupId = $statement->fetch()['id'] ?? null;

        if (!empty($adminGroupId)) {
            foreach ($adminPermissions as $adminPermission) {
                $statement = $connection->prepare(
                    'INSERT IGNORE INTO group_permission (group_id, permission_id) VALUES (:groupId, :permissionId)'
                );

                $statement->bindParam('groupId', $adminGroupId);
                $statement->bindParam('permissionId', $adminPermission);

                $statement->execute();
            }
        }
    }

    $statement = $connection->query('SELECT * FROM permission WHERE name = "login"');
    $userPermissions = array_column($statement->fetchAll(), 'id');

    if (!empty($userPermissions)) {
        $statement = $connection->query("SELECT id FROM system_group WHERE name = 'user'");
        $userGroupId = $statement->fetch()['id'] ?? null;

        if (!empty($userGroupId)) {
            foreach ($userPermissions as $userPermission) {
                $statement = $connection->prepare(
                    'INSERT IGNORE INTO group_permission (group_id, permission_id) VALUES (:groupId, :permissionId)'
                );

                $statement->bindParam('groupId', $userGroupId);
                $statement->bindParam('permissionId', $userPermission);

                $statement->execute();
            }
        }
    }

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
