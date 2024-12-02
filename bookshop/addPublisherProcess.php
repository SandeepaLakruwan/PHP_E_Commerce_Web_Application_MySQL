<?php
include "Database.php";

if (isset($_POST["pub"])) {

    $pub = $_POST["pub"];

    $a_rs = Connection::select("SELECT * FROM `publisher` WHERE `publisher_name`='" . $pub . "'");
    $a_num = $a_rs->num_rows;

    if ($a_num != 1) {
        Connection::iud("INSERT INTO `publisher`(`publisher_name`) VALUES ('" . $pub . "')");
        echo ("Successfully added new publisher");
    } else {
        echo ("Already have publisher.");
    }
} else {
    echo ("Somthing is missing.");
}
?>