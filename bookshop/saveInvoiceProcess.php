<?php

session_start();
include "Database.php";

if(isset($_SESSION["i"])){

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    $product_rs = Connection::select("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $current_qty = $product_data["qty"];
    $new_qty = $current_qty - $qty;

    Connection::iud("UPDATE `product` SET `qty`='".$new_qty."' WHERE `id`='".$pid."'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Connection::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`product_id`,`user_email`,`order_status_status_id`) 
    VALUES ('".$order_id."','".$date."','".$amount."','".$qty."','".$pid."','".$mail."','1')");

    echo ("success");

}

?>