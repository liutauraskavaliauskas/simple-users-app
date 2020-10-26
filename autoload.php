<?php

spl_autoload_register(
    static function ($className) {
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);

        var_dump(__DIR__ . '/Database/Database.php');
        var_dump(__DIR__ . '../' . $className . '.php');
        die;
    }
);
