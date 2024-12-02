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

        <title>Manage Sales | Unicorn</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="logo.jpg" />
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#79aaf7 0%,#0b244d 100%);" onload="loadSales();">

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
                                        <a class="nav-link" aria-current="page" href="adminPanel.php">Dashboard</a>
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
                            <h2 class="fw-bold">Manage Sales</h2>
                        </div>
                        <div class="col-3 mt-4 mb-1 align-self-center" id="dashName">
                            <h4 class="text-light fs-5">Admin - <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12 justify-content-center">

                            <!-- Model Body -->
                            <div class="mt-2">
                                <label class="form-label text-start fs-5">Status</label>
                                <!-- dropdown -->
                                <select class="form-select" aria-label="Small select example" id="statusSelect" onchange="loadSales();">
                                    <option selected value="0">All</option>
                                    <?php

                                    $table1 = Connection::select("SELECT * FROM `order_status`");

                                    for ($i = 0; $i < $table1->num_rows; $i++) {
                                        # code...
                                        $row1 = $table1->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($row1["status_id"]); ?>"><?php echo ($row1["status"]); ?></option>
                                    <?php

                                    }
                                    ?>

                                </select>

                            </div>
                            <div class="mt-4" id="salesViewDiv">

                            </div>


                            <!-- End Model Body -->

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