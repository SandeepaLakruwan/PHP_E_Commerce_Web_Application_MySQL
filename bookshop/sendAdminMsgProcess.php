<?php
include "Database.php";
session_start();

if(isset($_POST["msg"]) && isset($_POST["e"])){

    $msg = $_POST["msg"];
    $email = $_POST["e"];

            Connection::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) 
            VALUES ('".$msg."','".date('Y-m-d H:i:s')."','3','".$email."','sandeepaherath2001@gmail.com')");
            echo ("success");

}else{
    echo ("Somthing is missing.");
}

?>