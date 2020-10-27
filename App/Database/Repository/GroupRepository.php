<?php

namespace App\Database\Repository;

use App\Database\Database;
use App\Model\Group;
use App\Model\Permission;
use PDO;

class GroupRepository extends Database
{
    /**
     * @return Group[]
     */
    public function getAll(): array
    {
        $connection = $this->getConnection();

        $groups = [];

        if ($statement = $connection->prepare('SELECT * FROM system_group')) {
            $statement->execute();

            $fetchedGroups = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($fetchedGroups as $fetchedGroup) {
                $groups[] = Group::assign($fetchedGroup);
            }
        }

        $this->closeConnection();

        return $groups;
    }

    public function getGroupWithPermissions(int $groupId): Group
    {
        $group = new Group();

        $connection = $this->getConnection();

        $statement = $connection->prepare(
            'SELECT p.id, p.name FROM group_permission gp
LEFT JOIN permission p ON gp.permission_id = p.id
WHERE gp.group_id = :groupId'
        );

        $statement->bindParam('groupId', $groupId);

        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $group->addPermission($row['name'], Permission::assign($row));
        }

        $this->closeConnection();

        return $group;
    }

    /**
     * @param int $userId
     * @return Group[]
     */
    public function getUserGroups(int $userId): array
    {
        $groups = [];

        $connection = $this->getConnection();

        $statement = $connection->prepare(
            'SELECT sg.id, sg.name FROM user_group ug
LEFT JOIN system_group sg ON ug.group_id = sg.id
WHERE ug.user_id = :userId'
        );

        $statement->bindParam('userId', $userId);

        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $groups[$row['name']] = $this->getGroupWithPermissions($row['id']);
        }

        $this->closeConnection();

        return $groups;
    }

    public function addUserToGroup(int $userId, int $groupId): void
    {
        $connection = $this->getConnection();

        $statement = $connection->prepare(
            'INSERT IGNORE INTO user_group (user_id, group_id) VALUES (:userId, :groupId)'
        );

        $statement->bindParam('userId', $userId);
        $statement->bindParam('groupId', $groupId);

        $statement->execute();

        $this->closeConnection();
    }
}
