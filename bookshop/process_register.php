<?php

require "Database.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$password = $_POST["password"];
$password2 = $_POST["password2"];
$gender = $_POST["gender"];

if (empty($fname)) {
    echo ("Please enter your First Name !!!");
} else if (strlen($fname) > 50) {
    echo ("First Name must have less than 50 characters");
} else if (empty($lname)) {
    echo ("Please enter your Last Name !!!");
} else if (strlen($lname) > 50) {
    echo ("Last Name must have less than 50 characters");
} else if (empty($email)) {
    echo ("Please enter your Email !!!");
} else if (strlen($email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number Must Contain 10 Characters");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid Mobile Number");
} else if (empty($password)) {
    echo ("Please enter your Password !!!");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must be between 5 - 20 charcters");
} else if (empty($password2)) {
    echo ("Please confirm your Password !!!");
} else if (strlen($password2) < 5 || strlen($password2) > 20) {
    echo ("Password must be between 5 - 20 charcters");
} else if ($password != $password2) {
    echo ("Password must be wrong");
} else if ($gender == 0) {
    echo ("Please select your Gender !!!");
} else {

    $table = Connection::select("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $count = $table->num_rows;

    if ($count > 0) {
        echo ("Email already exists.");
    } else {

        try {
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Connection::iud("INSERT INTO `user` 
    (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`gender_gender_id`,`status_status_id`) VALUES 
    ('" . $fname . "','" . $lname . "','" . $email . "','" . $password . "','" . $mobile . "','" . $date . "','" . $gender . "','1')");



            $subject = "Welcome to Unicorn Bookshop!";
            $msg = 'Hi, Thankyou for joining with us ' . $fname . ' ' . $lname . '. <h2 style="color:blue;">Embrace the Magic of Reading.</h2>';

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'email';
            $mail->Password = 'password';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('email', 'Unicorn');
            $mail->addReplyTo('email', 'Unicorn');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $bodyContent = $msg;
            $mail->Body = $bodyContent;

            if (!$mail->send()) {
                // if mail didn't sent
                echo ("Error Occured Create User");
            } else {
                echo "success";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo ("Error");
        }
    }
}
