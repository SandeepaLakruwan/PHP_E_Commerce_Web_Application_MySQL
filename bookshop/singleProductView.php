<?php
include "Database.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Connection::select("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.author_has_publisher_id,
    product.status_status_id,product.admin_email,author.author_name AS oname,publisher.publisher_name AS pname FROM 
    `product` INNER JOIN `author_has_publisher` ON author_has_publisher.id=product.author_has_publisher_id INNER JOIN 
    `publisher` ON publisher.publisher_id=author_has_publisher.publisher_publisher_id INNER JOIN `author` ON 
    author.author_id=author_has_publisher.author_author_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | Unicorn</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="logo.jpg" />
        </head>

        <body style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">

            <div class="container-fluid">
                <div class="row">
                    <?php include "header.php"; ?>

                    <div class="col-12 mt-0 singleProduct">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">
                                <div class="row justify-content-center">

                                    <div class="col-12 col-lg-10 order-2 order-lg-1 d-flex bg-info bg-opacity-50 p-2 mb-2 shadow">
                                        <div class="row mt-2 justify-content-center">
                                            <div class="col-12 my-2 text-center">
                                                <span class="fs-3 fw-bold text-dark"><?php echo $product_data["title"]; ?></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-10 order-2 order-lg-1 d-flex">

                                        <?php
                                        $image_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;
                                        $img = array();

                                        if ($image_num != 0) {
                                            for ($x = 0; $x < $image_num; $x++) {
                                                $image_data = $image_rs->fetch_assoc();
                                                $img[$x] = $image_data["img_path"];
                                        ?>

                                                <div class="col-4 d-flex justify-content-center align-items-center mb-1" style="height:150px;">
                                                    <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" style="height:150px;" />
                                                </div>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-1 border-secondary mb-1" style="height:150px;">
                                                <img src="resource/empty.png" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(0);" style="height:150px;" />
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-1 border-secondary mb-1" style="height:150px;">
                                                <img src="resource/empty.png" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(1);" style="height:150px;" />
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-1 border-secondary mb-1" style="height:150px;">
                                                <img src="resource/empty.png" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(2);" style="height:150px;" />
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>


                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block mt-3">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="mainImg text-center mt-3" id="mainImg">
                                                    <?php
                                                    $image_rs2 = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                                    $image_num2 = $image_rs2->num_rows;

                                                    if ($image_num2 != 0) {

                                                        $image_data2 = $image_rs2->fetch_assoc();
                                                        $img2 = $image_data2["img_path"];
                                                    ?>
                                                        <img src="<?php echo ($img2) ?>" style="height:250px;" class="mt-5" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="resource/addproductimg.jpg" style="height:250px;" class="mt-5" />
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3 bg-success p-3 mt-3 bg-opacity-50 shadow">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">

                                                            &nbsp;

                                                            <?php
                                                            $feedback_rs2 = Connection::select("SELECT * FROM `feedback` WHERE `product_id`='" . $product_data["id"] . "'");
                                                            $feedback_num2 = $feedback_rs2->num_rows;
                                                            ?>

                                                            <label class="fs-5 text-dark fw-bold"><?php echo ($feedback_num2) ?> Reviews and Feedbacks</label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php

                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 10;
                                                $new_price = $price + $adding_price;
                                                $difference = $new_price - $price;

                                                ?>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-dark fw-bold">Rs. <?php echo $price; ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 text-warning fw-bold text-decoration-line-through">
                                                            Rs. <?php echo $new_price; ?> .00
                                                        </span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">Save Rs. <?php echo $difference; ?> .00 (10%)</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="text-light"><b>Return Policy : </b>2 Weeks Return Policy (*conditions apply)</span><br />
                                                        <span class="fs-5 text-warning"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row align-items-center">
                                                            <?php
                                                            $sold_rs = Connection::select("SELECT SUM(`qty`) AS `total` FROM `invoice` WHERE `product_id`='" . $product_data["id"] . "'");
                                                            $sold_num = $sold_rs->num_rows;
                                                            $sold_data = $sold_rs->fetch_assoc();


                                                            ?>
                                                            <div class="col-12 col-lg-6 border-dark text-center">
                                                                <span class="fs-5 text-dark"><b>Sold Quentity : </b><?php echo $sold_data["total"]; ?> Items</span>
                                                            </div>

                                                            <div class="col-12 col-lg-6 rounded overflow-hidden 
                                                        float-left position-relative product-qty d-flex">
                                                                <div class="col-12">
                                                                    <span class="m-1 mb-2">Quantity : </span>
                                                                    <!-- Cart value -->
                                                                    <?php
                                                                    $cartVal_rs = Connection::select("SELECT `qty` FROM `cart` WHERE `product_id`='" . $product_data["id"] . "'");
                                                                    $cartVal_num = $cartVal_rs->num_rows;

                                                                    if ($cartVal_num != "0") {
                                                                        $cartVal_data = $cartVal_rs->fetch_assoc();
                                                                    ?>
                                                                        <input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text" class="border-0 fs-5 fw-bold text-start mt-2 mb-1" style="outline: none;" pattern="[0-9]" value="<?php echo ($cartVal_data["qty"]) ?>" id="qty_input" />

                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text" class="border-0 fs-5 fw-bold text-start mt-2 mb-1" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" />

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <!-- End cart value -->

                                                                    <div class="position-absolute qty-buttons">
                                                                        <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
                                                                            <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                        </div>
                                                                        <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                                                            <i class="bi bi-caret-down-fill text-primary fs-5" onclick="qty_dec();"></i>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark mb-3">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">



                                                                    <div class="row">
                                                                        <div class="col-12 mt-3">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-dark" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-warning" onclick='addToCart(<?php echo $product_data["id"] ?>);'>
                                                                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <?php
                                                                                    if (isset($_SESSION["i"])) {

                                                                                        $watchlist_rs = Connection::select("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["i"]["email"] . "' 
                                                                                        AND `product_id`='" . $product_data["id"] . "'");
                                                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                                                        if ($watchlist_num == 1) {
                                                                                    ?>
                                                                                            <button class="btn btn-light" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                                                <i class="bi bi-bookmarks-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                                                            </button>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <button class="btn btn-light" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                                                <i class="bi bi-bookmarks-fill text-dark fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                                                            </button>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark shadow justify-content-center bg-light bg-opacity-50">
                                                    <div class="col-10">
                                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                                            <div class="col-12">
                                                                <span class="fs-4 fw-bold">Product Details</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            
                                                                    <label class="form-label fs-5 fw-bold">Publisher : <?php echo $product_data["pname"]; ?></label>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="row">
                                                                    <label class="form-label fs-5 fw-bold">Author : <?php echo $product_data["oname"]; ?></label>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="row">
                                                                    <label class="form-label"><b class="fs-4">Description : </b><?php echo $product_data["description"]; ?></label>
                                                                
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row g-2">

                                    <?php

                                    $related_rs = Connection::select("SELECT * FROM `product` 
                                    WHERE `author_has_publisher_id`='" . $product_data["author_has_publisher_id"] . "' LIMIT 5");

                                    $related_num = $related_rs->num_rows;
                                    for ($y = 0; $y < $related_num; $y++) {
                                        $related_data = $related_rs->fetch_assoc();
                                    ?>
                                        <div class="offset-1 offset-lg-0 col-4 col-lg-2 me-3" style="left: 10px;">
                                            <div class="card" style="width: 14rem;">
                                                <?php
                                                $pid = $related_data["id"];
                                                $img_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                                $img_num = $img_rs->num_rows;

                                                if ($img_num == 0) {
                                                ?>
                                                    <img src="resource/empty.svg" class="card-img-top" style="height: 150px;" />
                                                <?php
                                                } else {
                                                    $image_data = $img_rs->fetch_assoc();
                                                ?>
                                                    <img src="<?php echo $image_data["img_path"]; ?>" class="card-img-top" style="height: 150px;" />
                                                <?php
                                                }
                                                ?>
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $related_data["title"]; ?></h5>
                                                    <p class="card-text"><?php echo $related_data["description"]; ?></p>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($related_data["id"]); ?>' class="btn btn-primary">View Details...</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-dark">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold">Feedbacks</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 300px;">

                                    <?php

                                    $feedback_rs = Connection::select("SELECT * FROM `feedback` INNER JOIN `user` ON 
                                feedback.user_email=`user`.email WHERE `product_id`='" . $product_data["id"] . "'");
                                    $feedback_num = $feedback_rs->num_rows;

                                    for ($y = 0; $y < $feedback_num; $y++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();

                                    ?>
                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-dark rounded me-0 bg-success bg-opacity-25">

                                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $feedback_data["fname"] . " " . $feedback_data["lname"]; ?></div>
                                                <div class="col-2 mt-1 mb-1 me-0">

                                                    <?php

                                                    if ($feedback_data["type"] == 1) {
                                                    ?>
                                                        <span class="badge bg-success p-2 fs-5">Positive</span>
                                                    <?php
                                                    } else if ($feedback_data["type"] == 2) {
                                                    ?>
                                                        <span class="badge bg-warning p-2 fs-5">Neutral</span>
                                                    <?php
                                                    } else if ($feedback_data["type"] == 3) {
                                                    ?>
                                                        <span class="badge bg-danger p-2 fs-5">Negative</span>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>

                                                <div class="col-12">
                                                    <b>
                                                        <?php echo $feedback_data["feed"]; ?>
                                                    </b>
                                                </div>
                                                <div class="offset-6 col-6 text-end">
                                                    <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    ?>


                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        </body>

        </html>
<?php

    } else {
        echo ("Sorry for the inconvenience.Please try again later.");
    }
} else {
    echo ("Something Went Wrong.");
}

?>