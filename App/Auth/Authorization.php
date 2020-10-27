<?php

namespace App\Auth;

use App\Model\User;

class Authorization
{
    public static function canUserAccess(string $permission): void
    {
        $user = $_SESSION['currentUser'] ?? null;

        if (!$user instanceof User) {
            die ('No logged in user found!');
        }

        if (true !== $user->hasPermission($permission)) {
            die ('You don\'t have permission for this action!');
        }
    }

    public static function userHasPermission(string $permission): bool
    {
        $user = $_SESSION['currentUser'] ?? null;

        if (!$user instanceof User) {
            die ('No logged in user found!');
        }

        return $user->hasPermission($permission);
    }
}