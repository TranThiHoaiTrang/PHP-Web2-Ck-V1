<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Else_;

require 'vendor/autoload.php';
// --------------Factory----------
require 'models/FactoryPattent.php';
$factory = new FactoryPattent();
$HomeModel = $factory->make('home');
// --------------Factory----------

if (!empty($_POST['submit'])) {


    if ($_POST['username'] != '' && $_POST['email'] != '' && $_POST['password'] != '') {
        $insert = $HomeModel->createNewUser($_POST);
        if ($insert) {
            $mail = new PHPMailer(true);

            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'shopcake011@gmail.com';                     //SMTP username
            $mail->Password   = 'shopcake123456';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            $mail->isHTML(true);
            $mail->setFrom('shopcake011@gmail.com', 'CakeShop');
            $mail->addAddress($_POST['email'], 'Joe User');
            $mail->Subject = '[CAKE] Chao mung ban den voi the gioi cua cake';
            $mail->Body    = $_POST['username'] . ' Ơi, Chào mừng bạn đến với thế giới của Cake</b>
            Cảm ơn bạn đã chọn Cake để đồng hành. Mời bạn vào ứng dụng Cake để tìm hiểu và lựa chọn sản phẩm<b><p>Thân mến,<b><p>
            Cake team';
            if(!$mail->send()){
                echo 'MAILER ERROR';
            }
            else{
                echo 'Message has been sent';
            }

            header("location: login.php");
        } else {
            echo "<div class=\"alert alert-dark\" role=\"alert\">
                username error or pass not!</div>";
        }
    } else {
        echo "<div class=\"alert alert-dark\" role=\"alert\">Trường phải đủ</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="public/backend/css/font-face.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="public/backend/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="public/backend/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="public/backend/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="public/backend/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">

                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="public/backend/images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="aggree">Agree the terms and policy
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit" value="submit">register</button>
                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button class="au-btn au-btn--block au-btn--blue m-b-20">register with
                                            google</button>
                                    </div>
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="login.php">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="public/backend/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="public/backend/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="public/backend/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="public/backend/vendor/slick/slick.min.js">
    </script>
    <script src="public/backend/vendor/wow/wow.min.js"></script>
    <script src="public/backend/vendor/animsition/animsition.min.js"></script>
    <script src="public/backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="public/backend/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="public/backend/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="public/backend/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="public/backend/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="public/backend/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="public/backend/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="public/backend/js/main.js"></script>

</body>

</html>
<!-- end document-->