<?php

require_once '../autoload.php';

use App\Database\Database;

try {
    $database = new Database();
    $connection = $database->getConnection();

    // default test password is: liutauras
    // password_hash('liutauras', PASSWORD_BCRYPT) === '$2y$10$CsmdbrUH8K.0RQZJjKh5Q.4obRL8/e6y7XmUWVT0jTTTfRrmLdNm2'

    $connection->exec(
        'INSERT INTO user (email, password) 
VALUES ("user@liutauras.com", "$2y$10$CsmdbrUH8K.0RQZJjKh5Q.4obRL8/e6y7XmUWVT0jTTTfRrmLdNm2")
ON DUPLICATE KEY UPDATE email = email'
    );

    $database->closeConnection();
} catch (PDOException $exception) {
    echo sprintf('Got exception: %s', $exception->getMessage());
}
