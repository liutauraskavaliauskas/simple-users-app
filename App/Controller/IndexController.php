<?php

namespace App\Controller;

class IndexController
{
    public function index(): void
    {
        include 'Resources/views/index.html';
    }
}