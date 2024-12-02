<?php

session_start();
include "Database.php";

if(isset($_SESSION["i"])){

    $mail = $_SESSION["i"]["email"];
    $pid = $_POST["pid"];
    $type = $_POST["t"];
    $feed = $_POST["f"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Connection::iud("INSERT INTO `feedback`(`type`,`date`,`feed`,`product_id`,`user_email`) VALUES 
    ('".$type."','".$date."','".$feed."','".$pid."','".$mail."')");

    echo ("success");

}

?>