<?php
session_start();
include "Database.php";

if(isset($_POST["c"])){

    $v = $_POST["c"];

    $admin_rs = Connection::select("SELECT * FROM `admin` WHERE `vcode`='".$v."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num == 1){

        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["au"] = $admin_data;
        echo ("success");

    }else{
        echo ("Invalid Verification Code.");
    }

}else{
    echo ("Please enter the verification code.");
}
?>