<?php

require_once 'pdo_config.php';

try {
    $connection = new PDO(
        sprintf(
            'mysql:host=%s;dbname=%s',
            $host,
            $dbname
        ),
        $username,
        $password
    );
} catch (PDOException $exception) {
    die(
        sprintf(
            'Could not connect to the database $dbname :%s',
            $exception->getMessage()
        )
    );
}
