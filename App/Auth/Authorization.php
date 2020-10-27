<?php

namespace App\Auth;

use App\Model\User;

class Authorization
{
    public static function canUserAccess(string $permission): void
    {
        if (true !== self::userHasPermission($permission)) {
            die ('You don\'t have permission for this action!');
        }
    }

    public static function userHasPermission(string $permission): bool
    {
        return self::getCurrentUser()->hasPermission($permission);
    }

    private static function getCurrentUser(): User
    {
        $user = $_SESSION['currentUser'] ?? null;

        if (!$user instanceof User) {
            die ('No logged in user found!');
        }

        return $user;
    }
}