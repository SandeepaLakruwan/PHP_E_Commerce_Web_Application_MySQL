<?php

session_start();
include "Database.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel | Unicorn</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="logo.jpg" />
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#79aaf7 0%,#0b244d 100%);">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 align-items-start bg-dark vh-100">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-3">
                                    <div class="adminLogo"></div>
                                    <h4 class="text-white fw-bold">Unicorn Bookshop</h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active" aria-current="page" href="adminPanel.php">Dashboard</a>
                                        <a class="nav-link" href="manageUsers.php">Manage Users</a>
                                        <a class="nav-link" href="manageProducts.php">Manage Products</a>
                                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a>
                                        <a class="nav-link active fs-5" href="manageSales.php">Manage Sales</a>

                                    </nav>
                                </div>
                                <div class="col-12 mt-2">
                                    <hr class="border border-1 border-white" />
                                    <h5 class="text-white fw-bold">Total Active Time</h5>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mt-2 d-grid">
                                    <?php

                                    $start_date = new DateTime("2023-12-15 19:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);
                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);

                                    ?>

                                    <label class="form-label fw-bold text-primary">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds";
                                        ?>

                                    </label>
                                </div>
                                <div class="col-12 mt-4">
                                    <a class="btn btn-primary col-12" href="adminSignOutProcess.php">Sign Out</a>
                                </div>

                                <!-- Profile Model -->
                                <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #BA457C;">
                                                <h5 class="modal-title" id="exampleModalLabel">Admin Profile</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="background-color: #c5e1fa;">
                                                <?php

                                                $profile_rs = Connection::select("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["au"]["email"] . "'");
                                                $profile_num = $profile_rs->num_rows;

                                                if ($profile_num == 1) {
                                                    $profile_data = $profile_rs->fetch_assoc();
                                                }
                                                ?>
                                                <form>
                                                    <div class="form-group text-start">
                                                        <label for="email" class="col-form-label">Email:</label>
                                                        <input type="text" class="form-control" value="<?php echo ($profile_data["email"]) ?>" id="email" disabled>
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label for="fname" class="col-form-label">First Name:</label>
                                                        <input type="text" class="form-control" value="<?php echo ($profile_data["fname"]) ?>" id="fname">
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label for="lname" class="col-form-label">Last Name:</label>
                                                        <input type="text" class="form-control" value="<?php echo ($profile_data["lname"]) ?>" id="lname">
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer" style="background-color: #BA457C;">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="updateAdminProfile();">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Profile Model -->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="text-black fw-bold mb-1 mt-3 col-9">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>
                        <div class="col-3 mt-4 mb-1 align-self-center" id="dashName">
                            <h4 class="text-light fs-5">Admin - <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 text-white text-center rounded" style="height: 100px;">
                                            <div class="bg-primary bg-opacity-75 col-12 shadow">
                                                <span class="fs-4 fw-bold">Daily Earnings</span>
                                            </div>

                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoice_rs = Connection::select("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $f = $f + $invoice_data["qty"]; //total qty

                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d); //separate the date from time
                                                $pdate = $splitDate["0"]; //sold date

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $splitMonth = explode("-", $pdate); //separate date as year,month & day
                                                $pyear = $splitMonth["0"]; //year
                                                $pmonth = $splitMonth["1"]; //month

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $invoice_data["total"];
                                                        $e = $e + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>

                                            <br />
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 text-white text-center rounded" style="height: 100px;">
                                            <div class="bg-primary bg-opacity-75 col-12 shadow">
                                                <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            </div>
                                            <br />

                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 text-white text-center rounded" style="height: 100px;">
                                            <div class="bg-primary bg-opacity-75 col-12 shadow">
                                                <span class="fs-4 fw-bold">Today Sellings</span>
                                            </div>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 text-white text-center rounded" style="height: 100px;">
                                            <div class="bg-primary bg-opacity-75 col-12 shadow">
                                                <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            </div>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 text-white text-center rounded" style="height: 100px;">
                                            <div class="bg-primary bg-opacity-75 col-12 shadow">
                                                <span class="fs-4 fw-bold">Total Sellings</span>
                                            </div>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary bg-opacity-50 text-white text-center rounded" style="height: 100px;">
                                            <div class="bg-primary bg-opacity-75 col-12 shadow">
                                                <span class="fs-4 fw-bold">Total Engagements</span>
                                            </div>
                                            <br />
                                            <?php
                                            $user_rs = Connection::select("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="offset-1 col-10 col-lg-10 my-3 rounded bg-body bg-warning bg-opacity-75">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-decoration-underline">Mostly Sold Book</label>
                                </div>

                                <?php

                                $freq_rs = Connection::select("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` FROM `invoice` 
                                WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Connection::select("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Connection::select("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-4 text-center shadow">
                                        <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid rounded-top" style="height: 110px;" />
                                    </div>
                                    <div class="col-8 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <!-- empty product -->
                                    <div class="col-4 text-center shadow">
                                        <img src="resource/empty.png" class="img-fluid rounded-top" style="height: 110px;" />
                                    </div>
                                    <div class="col-8 text-center my-3">
                                        <span class="fs-5 fw-bold">-----</span><br />
                                        <span class="fs-6">--- items</span><br />
                                        <span class="fs-6">Rs. ----- .00</span>
                                    </div>
                                    <!-- empty product -->
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12 text-center text-black-50 mt-4 mb-2">
                        <label>unicorn.lk | Solution by Sandeepa&copy; <?php echo (date("Y")) ?></label>
                    </div>
                </div>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are not a valid user.");
}

?>