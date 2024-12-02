<?php 

session_start();
include "Database.php";

$email = $_SESSION["i"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$password = $_POST["pw"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$province = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

$user_rs = Connection::select("SELECT * FROM `user` WHERE `email`='".$email."'");

if($user_rs->num_rows == 1){

    Connection::iud("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',
    `mobile`='".$mobile."',`password`='".$password."' WHERE `email`='".$email."'");

    $address_rs = Connection::select("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");

    if($address_rs->num_rows == 1){

        Connection::iud("UPDATE `user_has_address` SET `city_city_id` = '".$city."',`line1`='".$line1."',
        `line2`='".$line2."',`postal_code`='".$pcode."' WHERE `user_email`='".$email."'");

    }else{

        Connection::iud("INSERT INTO `user_has_address`(`user_email`,`city_city_id`,`line1`,`line2`,`postal_code`) 
        VALUES ('".$email."','".$city."','".$line1."','".$line2."','".$pcode."')");

    }

    if(sizeof($_FILES) == 1){
        
        $image = $_FILES["i"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg","image/png","image/svg+xml");

        if(in_array($image_extension,$allowed_image_extensions)){
            $new_img_extension;

            if($image_extension == "image/jpeg"){
                $new_img_extension = ".jpeg";
            }else if($image_extension == "image/png"){
                $new_img_extension = ".png";
            }else if($image_extension == "image/svg+xml"){
                $new_img_extension = ".svg";
            }

            $file_name = "resource//profile_images//".$fname."_".uniqid().$new_img_extension;
            move_uploaded_file($image["tmp_name"],$file_name);

            $profile_img_rs = Connection::select("SELECT * FROM `profile_img` WHERE `user_email`='".$email."'");

            if($profile_img_rs->num_rows == 1){

                Connection::iud("UPDATE `profile_img` SET `path`='".$file_name."' WHERE `user_email`='".$email."'");
                echo ("Updated");

            }else{

                Connection::iud("INSERT INTO `profile_img`(`path`,`user_email`) VALUES ('".$file_name."','".$email."')");
                echo ("Saved");

            }
        }

    }else if(sizeof($_FILES) == 0){
        echo("You have not selected any image");
    }else if(sizeof($_FILES) >= 1){
        echo("You must select only 01 profile image");
    }

}else{
    echo ("Invalid user.");
}

?>