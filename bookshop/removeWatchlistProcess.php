<?php

include "Database.php";

$list_id = $_GET["id"];

$watchlist_rs = Connection::select("SELECT * FROM `watchlist` WHERE `w_id`='".$list_id."'");
$watchlist_num = $watchlist_rs->num_rows;

if($watchlist_num == 0){
    echo ("Something went wrong. Please try again later.");
}else{
    $watchlist_data = $watchlist_rs->fetch_assoc();

    $recent_rs = Connection::select("SELECT * FROM `recent` WHERE 
    `product_id`='".$watchlist_data["product_id"]."' AND `user_email`='".$watchlist_data["user_email"]."'");

    $recent_num = $recent_rs->num_rows;

    if($recent_num!=1){
    Connection::iud("INSERT INTO `recent`(`product_id`,`user_email`) VALUES 
                ('".$watchlist_data["product_id"]."','".$watchlist_data["user_email"]."')");
    }

    Connection::iud("DELETE FROM `watchlist` WHERE `w_id`='".$list_id."'");
    echo ("success");
    
}

?>