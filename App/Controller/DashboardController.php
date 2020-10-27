<?php

namespace App\Controller;

class DashboardController
{
    public function index(): void
    {
        header('Location: Resources/views/Dashboard/index.php');

        exit();
    }
}