<?php

require_once 'autoload.php';

use App\Controller\IndexController;
use App\Controller\LoginController;
use App\Database\Repository\UserRepository;

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (null !== $email && null !== $password) {
    $controller = new LoginController(new UserRepository());

    $controller->authenticate();
}

$controller = new IndexController();

$controller->index();
