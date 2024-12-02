<?php

session_start();
include "Database.php";

$email = $_SESSION["au"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$qty = $_POST["q"];
$cost = $_POST["co"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["de"];

// filds validation HW
if (empty($email)) {
    echo ("Session Expired!!!");
} else if ($category == 0) {
    echo ("Please select category");
} else if ($brand == 0) {
    echo ("Please select brand");
} else if ($model == 0) {
    echo ("Please select model");
} else if (empty($title)) {
    echo ("Please add title");
} else if (empty($qty)) {
    echo ("Please add product quentity");
} else if (empty($cost)) {
    echo ("Please add product cost");
} else if (empty($dwc)) {
    echo ("Please add delivery cost within Colombo");
} else if (empty($doc)) {
    echo ("Please add delivery cost out of Colombo");
} else if (empty($desc)) {
    echo ("Please add product description");
} else {

    $mhb_rs = Connection::select("SELECT * FROM `author_has_publisher` WHERE `author_author_id`='" . $model . "' AND 
    `publisher_publisher_id`='" . $brand . "'");

    $model_has_brand_id;

    if ($mhb_rs->num_rows > 0) {

        $mhb_data = $mhb_rs->fetch_assoc();
        $model_has_brand_id = $mhb_data["id"];
    } else {

        Connection::iud("INSERT INTO `author_has_publisher`(`author_author_id`,`publisher_publisher_id`) VALUES 
    ('" . $model . "','" . $brand . "')");
        $model_has_brand_id = Connection::$connection->insert_id;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Connection::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
    `delivery_fee_other`,`category_cat_id`,`author_has_publisher_id`,`status_status_id`,
    `admin_email`) VALUES ('" . $cost . "','" . $qty . "','" . $desc . "','" . $title . "','" . $date . "','" . $dwc . "','" . $doc . "',
    '" . $category . "','" . $model_has_brand_id . "','" . $status . "','" . $email . "')");

    $product_id = Connection::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 3 && $length > 0) {

        $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {

                $image_file = $_FILES["image" . $x];
                $file_extension = $image_file["type"];

                if (in_array($file_extension, $allowed_image_extensions)) {

                    $new_img_extension;

                    if ($file_extension == "image/jpeg") {
                        $new_img_extension = ".jpeg";
                    } else if ($file_extension == "image/png") {
                        $new_img_extension = ".png";
                    } else if ($file_extension == "image/svg+xml") {
                        $new_img_extension = ".svg";
                    }

                    $file_name = "resource//product_img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    Connection::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
                    ('" . $file_name . "','" . $product_id . "')");
                } else {
                    echo ("Inavid image type.");
                }
            }
        }

        echo ("success");
    } else {
        echo ("Invalid Image Count.");
    }
}
