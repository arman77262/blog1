<?php
require_once '../lib/Session.php';
Session::loginCheck();
require_once '../lib/Database.php';
require_once '../config/config.php';
require_once '../helpers/Format.php';

/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/src/Exception.php';
require_once 'phpmailer/src/PHPMailer.php';
require_once 'phpmailer/src/SMTP.php';*/


$db = new Database();
$fr = new Format();

if (isset($_POST['sendmail'])){
    $email = mysqli_real_escape_string($db->link, $_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid Email Address";
    }else{
        $mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
        $mailcheck = $db->select($mailquery);
        if ($mailcheck != false){
            while ($row = mysqli_fetch_assoc($mailcheck)){
                $userid = $row['id'];
                $username = $row['username'];
            }

            $text = substr($email, 0 ,4);
            $rand = rand(10000,99999);
            $newpass = "$text$rand";
            $password = md5($newpass);
            $query = "UPDATE `tbl_user` SET `password`='$password' WHERE id='$userid'";
            $uppass = $db->update($query);
            $to = $email;
            $from = 'armanhossain01516@gmail.com';
            $headers= "From: $from \n";
            // To send HTML mail, the Content-type header must be set
            $headers .= 'MIME-Version: 1.0';
            $headers .= 'Content-type: text/html; charset=iso-8859-1';

            $subject = "Your Password";
            $message = "Your Username is: ". $username. "And Password is: ".$newpass ;

            $sendmail = mail($to, $subject, $message, $headers);
            if ($sendmail){
                $success = "Email Already Send";
            }else{
                $error = "Something Wrong Mail Not send";
            }

        }else{
            $error = "Email Address Is Not Exsist";
        }
    }


    /*$email = $_POST['email'];
    $code = uniqid(true);
    $query = "INSERT INTO `pwd_reset`(`code`, `email`) VALUES ('$code','$email')";
    $result = $db->insert($query);
    if (!$result){
        exit("Error");
    }

    $mail = new PHPMailer;

    //Enable SMTP debugging.
    // $mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password
    $mail->Username = "robartjack79@gmail.com";
    $mail->Password = "7726264621";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "robartjack79@gmail.com";
    $mail->FromName = "Arman";

    $mail->addAddress($email, "Arman");
    $url = "http://localhost/blog/resetPassword.php?code=$code";
    $mail->isHTML(true);
    $mail->Subject = "Your Password reset link";
    $mail->Body = "<h1>You request the passwor reset</h1>
                           Click <a href='$url'>This link</a> to do so";

    if(!$mail->send())
    {
        $error = "Mail Not Send";
    }
    else
    {
        $success = "Reset Password link has been sent to you email";
    }*/
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
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required>
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