<?php

require_once 'autoload.php';

use App\Controller\IndexController;
use App\Controller\LoginController;
use App\Database\Repository\UserRepository;

$userName = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (null !== $userName && null !== $password) {
    $controller = new LoginController(new UserRepository());

    $redirect = $controller->authenticate();

    header($redirect);
}

$controller = new IndexController();

$controller->index();
