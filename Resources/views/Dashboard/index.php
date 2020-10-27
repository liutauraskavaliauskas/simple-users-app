<?php

require_once '../../../autoload.php';

use App\Database\Repository\UserRepository;

session_start();

$users = (new UserRepository())->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simple users application</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../../assets/images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="../../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $key => $user) {
                ?>
                    <tr>
                        <th scope="row"><?php
                            echo ++$key; ?></th>
                        <td><?php
                            echo $user->getEmail() ?></td>
                        <td><?php
                            echo $user->getCreatedAt()->format('Y-m-d H:i:s') ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>

            <?php if (App\Auth\Authorization::userHasPermission('dashboard_new_user')) { ?>
                <a href="newUser.php" class="btn btn-primary">Add new user</a>
            <?php } ?>
        </div>
    </div>
</div>

<script src="../../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../../assets/vendor/animsition/js/animsition.min.js"></script>
<script src="../../assets/vendor/bootstrap/js/popper.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/vendor/select2/select2.min.js"></script>
<script src="../../assets/vendor/daterangepicker/moment.min.js"></script>
<script src="../../assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="../../assets/vendor/countdowntime/countdowntime.js"></script>
<script src="../../assets/js/main.js"></script>

</body>
</html>