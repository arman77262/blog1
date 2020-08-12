<?php
require_once '../lib/Session.php';
Session::loginCheck();
require_once '../lib/Database.php';
require_once '../config/config.php';
require_once '../helpers/Format.php';



$db = new Database();
$fr = new Format();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>Password Recovery</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />


</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" action="" method="post">

        <h2 class="form-signin-heading">New Password</h2>
        <?php
        if (isset($error)){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?=$error?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>

        <?php
        if (isset($success)){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?=$success?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
        <div class="login-wrap">
            <input type="text" name="newpass" class="form-control" placeholder="Enter Your New Password" required>
            <?php
            /*                if (isset( $input_error['username'] )){
                                echo '</span>'. $input_error['username'] .'</span>';
                            }
                        */?>
            <label class="checkbox">
                <span class="pull-right">
                    <a href="login.php">Login</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" name="sendmail" type="submit">Send Mail</button>


        </div>


    </form>

</div>



<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>