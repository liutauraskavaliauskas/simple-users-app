<?php

spl_autoload_register(
    static function () {
        require_once __DIR__ . '/Database/Database.php';
    }
);
