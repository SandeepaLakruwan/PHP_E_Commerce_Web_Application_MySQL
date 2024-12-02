<?php include "Database.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Purchasing History | Unicorn</title>

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
                $mail = $_SESSION["i"]["email"];

                $invoice_rs = Connection::select("SELECT * FROM `invoice` INNER JOIN `order_status` 
                ON `invoice`.`order_status_status_id`=`order_status`.`status_id` WHERE `user_email`='" . $mail . "' ORDER BY `date` DESC");
                $invoice_num = $invoice_rs->num_rows;

            ?>
                <div class="col-12 text-center mb-3">
                    <span class="fs-1 fw-bold text-black">Purchasing History</span>
                </div>

                <?php

                if ($invoice_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-12 text-center bg-body" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                            You have not purchased any item yet...
                        </span>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                ?>
                    <!-- Have Product -->
                    <div class="col-12">
                        <div class="row">

                            <?php

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();

                            ?>
                                <div class="col-12">
                                    <hr />
                                </div>
                                <div class="col-12 bg-primary bg-opacity-25 mt-2 shadow">
                                    <div class="row">

                                        <div class="col-12 bg-primary bg-opacity-50 text-start p-1 d-flex pt-2 pb-2 shadow">
                                            <label class="form-label text-white fs-5 col-7 offset-1">Order Id - <?php echo $invoice_data["order_id"]; ?></label>
                                            <div class="col-4 text-center">
                                                <?php

                                                if ($invoice_data["status_id"] == "1") {
                                                ?>
                                                    <button class="btn btn-danger rounded col-9">
                                                    <?php
                                                } else if ($invoice_data["status_id"] == "2") {
                                                    ?>
                                                        <button class="btn btn-warning rounded col-9">
                                                        <?php
                                                    } else if ($invoice_data["status_id"] == "3") {
                                                        ?>
                                                            <button class="btn btn-success rounded col-9">
                                                            <?php
                                                        }

                                                            ?>

                                                            <?php echo $invoice_data["status"]; ?>
                                                            </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row justify-content-center">
                                                <div class="card my-3 col-11 text-center">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                            <?php

                                                            $details_rs = Connection::select("SELECT * FROM `product` INNER JOIN 
                                                    `product_img` ON product.id=product_img.product_id INNER JOIN 
                                                    `admin` ON product.admin_email=`admin`.email WHERE `id`='" . $invoice_data["product_id"] . "'");

                                                            $product_data = $details_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                                        </div>
                                                        <div class="col-md-8 bg-success bg-opacity-25">
                                                            <div class="card-body">

                                                                <h5 class="card-title"><b>Book Name : </b><?php echo $product_data["title"]; ?></h5>
                                                                <p class="card-text"><b>Seller : </b><?php echo $product_data["fname"] . " " . $product_data["lname"]; ?></p>

                                                                <label class="card-text fs-6"><b>Quentity : </b><?php echo $invoice_data["qty"]; ?></label><br />
                                                                <label class="card-text fs-6"><b>Total Amount : </b>Rs. <?php echo $invoice_data["total"]; ?> .00</label><br />
                                                                <label class="card-text fs-6"><b>Buying Time : </b><?php echo $invoice_data["date"]; ?></label>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-6 d-grid">
                                                                        <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="addFeedback(<?php echo $product_data['id']; ?>);">
                                                                            <i class="bi bi-info-circle-fill"></i> Feedback
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- model -->
                            <div class="modal" tabindex="-1" id="feedbackmodal<?php echo $product_data['id']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #BA457C;">
                                            <h5 class="modal-title fw-bold">Add New Feedback</h5><br/>        
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="background-color: #c5e1fa;">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                        <p class="text-danger fs-4 mt-1 mb-3"><?php echo $product_data["title"];?></p>
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Type</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type1<?php echo $product_data['id']; ?>"/>
                                                                    <label class="form-check-label text-success fw-bold" for="type1">
                                                                        Positive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type2<?php echo $product_data['id']; ?>" checked />
                                                                    <label class="form-check-label text-dark fw-bold" for="type2">
                                                                        Neutral
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type3<?php echo $product_data['id']; ?>"/>
                                                                    <label class="form-check-label text-danger fw-bold" for="type3">
                                                                        Negative
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">User's Email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" disabled id="mail<?php echo $product_data['id']; ?>" value="<?php echo $mail; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Feedback</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea class="form-control" cols="50" rows="8" id="feed<?php echo $product_data['id']; ?>"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: #BA457C;">
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">Save Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model -->
                            <?php
                            }

                            ?>



                            <div class="col-12">
                                <hr />
                            </div>

                            

                        </div>
                    </div>
                    <!-- Have Product -->
            <?php
                }
            }

            ?>



            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>