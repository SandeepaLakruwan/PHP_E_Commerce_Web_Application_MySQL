<?php 
    session_start();
    require "Database.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember = $_POST["remember"];

    if (empty($email)) {
        echo ("Please enter your Email !!!");
    } else if (strlen($email) >= 100) {
        echo ("Email must have less than 100 characters");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ("Invalid Email !!!");
    }else if(empty($password)){
        echo ("Please enter your Password");
    }else if(strlen($password) < 5 || strlen($password) > 20){
        echo ("Password must between 5 - 20 characters!");
    }else{

        $user_rs = Connection::select("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$password."'");
        $n = $user_rs->num_rows;

        if($n>0){
            
            $user_data = $user_rs->fetch_assoc();
            $_SESSION["i"] = $user_data;
            setcookie("name",$user_data['fname']);

            if($remember == "true"){

                setcookie("email",$user_data['email'],time()+ (60*60*24 * 365));
                setcookie("password",$user_data['password'],time()+ (60*60*24 * 365));
                
                
            }else{
                setcookie("email","",time()-1);
                setcookie("password","",time()-1);
            }

            echo ("student");

            }else{
            echo'Invalid username or password';
            }
        }
?>