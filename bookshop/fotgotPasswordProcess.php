<?php

include "Database.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Connection::select("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        $code = uniqid();
        Connection::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'email';
        $mail->Password = 'password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('email', 'Reset Password');
        $mail->addReplyTo('email', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Unicorn Forgot password Verification Code';
        $bodyContent = '<h2 style="color:green;">Your Verification Code is </h2><h1 style="color:red">'.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo 'Verification code sending failed.';
        }else{
            echo 'Success';
        }

    } else {
        echo ("Invalid Email Address");
    }
} else {
    echo ("Please Enter Your Email Address in Email Field.");
}
