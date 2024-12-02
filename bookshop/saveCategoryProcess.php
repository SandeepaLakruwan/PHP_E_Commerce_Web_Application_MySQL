<?php
include "Database.php";

if(isset($_POST["t"]) && isset($_POST["e"]) && isset($_POST["n"])){

    $vcode = $_POST["t"];
    $umail = $_POST["e"];
    $cname = $_POST["n"];

    $admin_rs = Connection::select("SELECT * FROM `admin` WHERE `email`='".$umail."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num == 1){

        $admin_data = $admin_rs->fetch_assoc();
        if($admin_data["vcode"] == $vcode){

            Connection::iud("INSERT INTO `category`(`cat_name`) VALUES ('".$cname."')");
            echo ("success");

        }else{
            echo ("Invalid Verification code.");
        }
    }else{
        echo ("Invalid User.");
    }

}else{
    echo ("Somthing is missing.");
}

?>