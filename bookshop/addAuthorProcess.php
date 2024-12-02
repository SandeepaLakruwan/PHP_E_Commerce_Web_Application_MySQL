<?php
include "Database.php";

if (isset($_POST["aut"])) {

    $aut = $_POST["aut"];

    $a_rs = Connection::select("SELECT * FROM `author` WHERE `author_name`='" . $aut . "'");
    $a_num = $a_rs->num_rows;

    if ($a_num != 1) {
        Connection::iud("INSERT INTO `author`(`author_name`) VALUES ('" . $aut . "')");
        echo ("Successfully added new author");
    } else {
        echo ("Already have author.");
    }
} else {
    echo ("Somthing is missing.");
}
?>