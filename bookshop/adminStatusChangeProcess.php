<?php

include "Database.php";

if(isset($_POST["s"]) & isset($_POST["i"])){

    $status = $_POST["s"];
    $invoice_id = $_POST["i"];
    
    if($status=="1"){
        Connection::iud("UPDATE `invoice` SET `order_status_status_id`='2' WHERE `invoice_id`='".$invoice_id."'");
        echo("Order Placed");
    }else if($status=="2"){
        Connection::iud("UPDATE `invoice` SET `order_status_status_id`='3' WHERE `invoice_id`='".$invoice_id."'");
        echo("Delivered");
    }else{
        echo("Delivered");
    }

}else{
    echo ("Something went wrong.");
}

?>