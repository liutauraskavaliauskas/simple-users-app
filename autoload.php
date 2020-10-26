<?php

spl_autoload_register(
    static function ($className) {
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

        require_once __DIR__ . '/' . $className . '.php';
    }
);
