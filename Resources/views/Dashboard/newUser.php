<?php

require_once '../../../autoload.php';

use App\Auth\Authorization;
use App\Controller\UserController;
use App\Database\Repository\GroupRepository;
use App\Database\Repository\UserRepository;

session_start();

Authorization::canUserAccess('user_create');

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (null !== $email && null !== $password) {
    $controller = new UserController(new UserRepository());

    $controller->create();
}

$groups = (new GroupRepository())->getAll();

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
            <form action="" method="POST" class="login100-form validate-form flex-sb flex-w">
                <span class="login100-form-title p-b-32">
                    New User
                </span>

                <span class="txt1 p-b-11">
                    Email
                </span>

                <div class="wrap-input100 validate-input m-b-36" data-validate="Email is required">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100"></span>
                </div>

                <span class="txt1 p-b-11">
                    Password
                </span>

                <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
                    <span class="btn-show-pass">
                        <i class="fa fa-eye"></i>
                    </span>
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                </div>

                <span class="txt1 p-b-11">
                    User group
                </span>

                <div class="wrap-input100 validate-input m-b-12" data-validate="User group is required">
                    <select class="custom-select" name="group" style="width: 100%">
                        <?php foreach ($groups as $group) { ?>
                            <option value="<?php echo $group->getId(); ?>">
                                <?php echo ucfirst($group->getName()); ?>
                            </option>
                        <? } ?>
                    </select>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Create
                    </button>
                </div>
            </form>
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
