<?php include "Database.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Unicorn</title>

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

                $watchlist_rs = Connection::select("SELECT * FROM `watchlist` INNER JOIN `product` ON 
                watchlist.product_id=product.id INNER JOIN `admin` ON 
                product.admin_email=admin.email WHERE watchlist.user_email='" . $_SESSION["i"]["email"] . "'");

                $watchlist_num = $watchlist_rs->num_rows;

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-primary rounded mb-2">
                            <div class="row align-items-center justify-content-center">

                                <div class="col-12 col-lg-12 mt-2">
                                    <label class="form-label fs-1 fw-bolder"><i class="bi bi-bookmarks-fill fs-2 text-primary"> Watchlist</i></label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <?php

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist
                                                    yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $list_id = $watchlist_data["w_id"];
                                            ?>

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12 bg-primary bg-opacity-25">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                            <?php


                                                            $img_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">

                                                                <h5 class="card-title fs-2 fw-bold text-light"><?php echo $watchlist_data["title"]; ?></h5>

                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $watchlist_data["price"]; ?> .00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity
                                                                    :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $watchlist_data["qty"]; ?> Items available</span>
                                                                <br />
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a href='<?php echo "singleProductView.php?id=" . ($watchlist_data["id"]); ?>' class="btn btn-success mb-2">Buy Now</a>
                                                                <a href="#" class="btn btn-warning mb-2"  onclick="addToCart(<?php echo $watchlist_data['id']; ?>);">
                                                                    <i class="bi bi-cart-plus-fill"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick='removeFromWatchlist(<?php echo $list_id; ?>);'>
                                                                <i class="bi bi-trash3-fill"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- have products -->
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } else {
            ?>
                <script>
                    window.location = "home.php";
                </script>
            <?php
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>