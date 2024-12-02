<?php
session_start();
include "Database.php";

if(isset($_SESSION["i"])){

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["i"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Connection::select("SELECT * FROM `product` WHERE `id`='".$id."'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Connection::select("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_city_id"];
        $address = $city_data["line1"].", ".$city_data["line2"];

        $district_rs = Connection::select("SELECT * FROM `city` WHERE `city_id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_district_id"];
        $delivery = "0";

        if($district_id == "1"){
            $delivery = $product_data["delivery_fee_colombo"];
        }else{
            $delivery = $product_data["delivery_fee_other"];
        }

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["i"]["fname"];
        $lname = $_SESSION["i"]["lname"];
        $mobile = $_SESSION["i"]["mobile"];
        $uaddress = $address;
        $city = $district_data["city_name"];

        $merchant_id = "merchant_id";
        $merchant_secret = "merchant_secret";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["umail"] = $umail;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);

    }else{
        echo ("2");
    }

}else{
    echo ("1");
}

?>
