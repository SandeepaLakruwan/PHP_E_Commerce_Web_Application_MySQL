<?php 

session_start();

if(isset($_SESSION["au"])){

    $_SESSION["au"] = null;
    session_destroy();

    echo("success");
    header("Location: adminSignIn.php");
    exit();
}

?>