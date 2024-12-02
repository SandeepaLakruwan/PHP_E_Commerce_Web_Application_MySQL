<?php

include "Database.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    Connection::iud("DELETE FROM `cart` WHERE `cart_id`='".$cid."'");
    echo ("Removed");

}else{
    echo ("Something went wrong.");
}

?>