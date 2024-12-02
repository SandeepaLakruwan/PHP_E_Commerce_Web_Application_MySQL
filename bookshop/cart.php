<?php
include "Database.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | Unicorn</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />

</head>

<body style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["i"])) {

                $user = $_SESSION["i"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>

                <div class="col-12 border border-1 border-primary rounded mb-3">
                    <div class="row">

                        <div class="col-12 col-lg-12 mt-2">
                            <label class="form-label fs-1 fw-bold"><i class="bi bi-cart4 fs-1 text-primary"> Cart</i></label>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php

                        $cart_rs = Connection::select("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php
                        } else {
                        ?>
                            <!-- products -->
                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Connection::select("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                        product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Connection::select("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON 
                                    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 1) {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {
                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }

                                        $seller_rs = Connection::select("SELECT * FROM `admin` WHERE `email`='" . $product_data["admin_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                    ?>
                                        <div class="card mb-3 mx-0 col-12 bg-primary bg-opacity-25">
                                            <div class="row g-0">
                                                

                                                <div class="col-md-4 mt-3">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                        <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>,<?php echo $product_data['qty']; ?>);" id="qty_num<?php echo $cart_data['cart_id']; ?>">
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $ship; ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 bg-light bg-opacity-10 align-items-center shadow mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12 text-center mt-3">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-12 text-center mb-3">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                        </div>
                                                        <div class="card-body d-block text-center">
                                                            <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="btn btn-success mb-2 col-10">Buy Now</a>
                                                            <a class="btn btn-danger mb-2 col-10" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);"><i class="bi bi-trash3-fill"></i></a>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>

                            <!-- products -->

                            <!-- summary -->
                            <div class="col-12 col-lg-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                </div>
                            </div>
                            <!-- summary -->
                        <?php
                        }

                        ?>

                    </div>
                </div>
            <?php
            } else {
                echo ("Please Login or Signup first.");
            }
            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>