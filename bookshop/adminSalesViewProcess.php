<?php
require("Database.php");

$status_id = $_POST["s"];

?>

<div class="col-12 mt-1 m-2 p-2 bg-white bg-opacity-25 shadow">
    <div class="row">
        <div class="col-2">
            <label class="fs-5 text-black-50 text-break">Invoice Id</label>
        </div>
        <div class="col-4">
            <label class="fs-5 text-success text-break">Order Id</label>
        </div>
        <div class="col-4">
            <label class="fs-5 text-black text-break">Status</label>
        </div>
        <div class="col-2">
            <label class="fs-5 text-dark text-break">Date</label>
        </div>
    </div>
</div>

<?php
try {
    if ($status_id == "0") {

        $table10 = Connection::select("SELECT * FROM `invoice` INNER JOIN `order_status` 
        ON `invoice`.`order_status_status_id`=`order_status`.`status_id`");
    } else {

        $table10 = Connection::select("SELECT * FROM `invoice` INNER JOIN `order_status` 
        ON `invoice`.`order_status_status_id`=`order_status`.`status_id` WHERE `status_id`='" . $status_id . "'");
    }
    if ($table10->num_rows) {
        for ($i = 0; $i < $table10->num_rows; $i++) {
            $row10 = $table10->fetch_assoc();

?>


            <div class="col-12 mt-1 m-1 p-2 bg-white bg-opacity-50 shadow" data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo ($i) ?>" aria-expanded="false" aria-controls="collapseExample<?php echo ($i) ?>">
                <div class="row">

                    <div class="col-2">
                        <label class="fs-5 text-black-50"><?php echo ($row10["invoice_id"]) ?></label>
                    </div>
                    <div class="col-4">
                        <label class="fs-5 text-success"><?php echo ($row10["order_id"]) ?></label>
                    </div>
                    <div class="col-4">
                        <label class="fs-5 text-black"><?php echo ($row10["status"]) ?></label>
                        
                    </div>
                    <div class="col-2">
                        <label class="fs-5 text-secondary"><?php echo ($row10["date"]) ?></label>
                    </div>
                </div>
            </div>

            <div class="collapse" id="collapseExample<?php echo ($i) ?>">
                <?php

                $table11 = Connection::select("SELECT * FROM `product` WHERE `id`='" . $row10["product_id"] . "'");

                if ($table11->num_rows) {
                    $row11 = $table11->fetch_assoc();

                ?>
                    <div class="card card-body col-12">

                        <div class="row justify-content-center">
                            <div class="col-5 bg-primary bg-opacity-10 d-block m-1 text-center">
                                <div class="col-12 bg-primary bg-opacity-25 shadow mb-3">
                                    <label>Product Details</label>
                                </div>
                                <label class="text-danger">Product Id - <?php echo ($row11["id"]) ?></label></br>
                                <label class="text-success">Name - <?php echo ($row11["title"]) ?></label></br>
                                <label>Price - <?php echo ($row11["price"]) ?></label></br>
                                <label>Available Quentity - <?php echo ($row11["qty"]) ?></label>
                                <label class="mt-3 btn btn-success col-10 mb-2">
                                    Ordered Qty - <?php echo ($row10["qty"]) ?></br>
                                    Amount - Rs.<?php echo ($row10["total"]) ?>
                                </label>
                                <button class="btn btn-danger mb-4" onclick="orderStatusChange(<?php echo($row10['status_id'])?>,<?php echo($row10['invoice_id'])?>);">Change Status</button>
                            </div>

                            <?php
                            $table12 = Connection::select("SELECT * FROM `user` INNER JOIN `user_has_address` 
                            ON `user`.`email`=`user_has_address`.`user_email` INNER JOIN `city` 
                            ON `user_has_address`.`city_city_id`=`city`.`city_id` INNER JOIN `district` 
                            ON `city`.`district_district_id`=`district`.`district_id` WHERE `email`='" . $row10["user_email"] . "'");

                            if ($table12->num_rows) {
                                $row12 = $table12->fetch_assoc();

                            ?>
                                <div class="col-5 bg-primary bg-opacity-10 d-block m-1 text-center">
                                    <div class="col-12 bg-primary bg-opacity-25 shadow mb-3">
                                        <label>Customer Details</label>
                                    </div>
                                    <label class="text-danger">Email - <?php echo ($row12["email"]) ?></label></br>
                                    <label class="text-success">Name - <?php echo ($row12["fname"]) ?> <?php echo ($row12["lname"]) ?></label></br>
                                    <label class="text-black">mobile - <?php echo ($row12["mobile"]) ?></label></br>
                                    <label class="text-black"><?php echo ($row12["line1"]) ?>,</label></br>
                                    <label class="text-black"><?php echo ($row12["line2"]) ?>,</label></br>
                                    <label class="text-black"><?php echo ($row12["city_name"]) ?>,</label></br>
                                    <label class="text-black"><?php echo ($row12["district_name"]) ?>.</label></br>
                                    <label class="text-black"><?php echo ($row12["postal_code"]) ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                <?php

                } else {
                ?>
                    <div class="card card-body">
                        No details available
                    </div>

                <?php
                }

                ?>

            </div>

    <?php
        }
    }
} catch (\Throwable $th) {
    ?>
    <div class="card card-body">
        Error loading
    </div>
    
<?php
}

?>