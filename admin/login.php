<?php
    require_once '../lib/Session.php';
    Session::loginCheck();
    require_once '../lib/Database.php';
    require_once '../config/config.php';
    require_once '../helpers/Format.php';

    $db = new Database();
    $fr = new Format();

    if (isset($_POST['login'])){
        $username = $fr->validation($_POST['username']);
        $password = $fr->validation($_POST['password']);
        $password = md5($password);
        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);

        $query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
        $result = $db->select($query);
        if ($result != false){
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                Session::set('login', true);
                Session::set('username', $row['username']);
                Session::set('userid', $row['id']);
                Session::set('userRole', $row['role']);
                Session::set('name',$row['name']);
                header("location:index.php");
            }else{
                $error = "Username Or Password Not Match";
            }
        }else{
            $error = "Invalid Username Or Password";
        }
    }

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

    <title>Admin Login</title>

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

        <h2 class="form-signin-heading">sign in now</h2>
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
        <div class="login-wrap">
            <input type="text" name="username" class="form-control" placeholder="User ID" required>
            <?php
            /*                if (isset( $input_error['username'] )){
                                echo '</span>'. $input_error['username'] .'</span>';
                            }
                        */?>
            <input type="password" name="password" class="form-control" placeholder="Password">
            <label class="checkbox">
                <span class="pull-right">
                    <a href="forgetpass.php"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" name="login" type="submit">Sign in</button>

            <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
                <p>
                    <?/*=isset($login_error)?$login_error:''*/?>
                </p>
            </div>

        </div>


    </form>

</div>



<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>