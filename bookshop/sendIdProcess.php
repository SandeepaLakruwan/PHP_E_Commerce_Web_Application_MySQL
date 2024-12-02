<?php 

session_start();
include "Database.php";

$pid = $_GET["id"];

$product_rs = Connection::select("SELECT * FROM `product` WHERE `id`='".$pid."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){
    $product_data = $product_rs->fetch_assoc();
    $_SESSION["p"] = $product_data;

    echo ("Success");
}else {
    echo ("Something went wrong. Please try later.");
}

?>