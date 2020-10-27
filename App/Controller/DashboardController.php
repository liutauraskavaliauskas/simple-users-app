<?php

namespace App\Controller;

use App\Auth\Authorization;

class DashboardController
{
    public function index(): void
    {
        Authorization::canUserAccess('dashboard_index');

        header('Location: Resources/views/Dashboard/index.php');

        exit();
    }
}