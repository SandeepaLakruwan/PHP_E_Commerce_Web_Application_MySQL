<?php
include "Database.php";
session_start();

if(isset($_POST["msg"])){

    $msg = $_POST["msg"];

            Connection::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) 
            VALUES ('".$msg."','".date('Y-m-d H:i:s')."','1','".$_SESSION["i"]["email"]."','sandeepaherath2001@gmail.com')");
            echo ("success");

}else{
    echo ("Somthing is missing.");
}

?>