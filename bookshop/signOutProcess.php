<?php 

session_start();

if(isset($_SESSION["i"])){

    $_SESSION["i"] = null;
    session_destroy();

    echo("success");
}

?>