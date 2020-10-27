<?php

namespace App\Controller;

class IndexController
{
    public function index(): void
    {
        session_start();

        include 'Resources/views/Login/index.html';
    }
}