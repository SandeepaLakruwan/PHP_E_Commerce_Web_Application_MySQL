<?php
include "Database.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | Unicorn</title>

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
                                    <a class="nav-link" aria-current="page" href="adminPanel.php">Dashboard</a>
                                    <a class="nav-link" href="manageUsers.php">Manage Users</a>
                                    <a class="nav-link active" href="manageProducts.php">Manage Products</a>
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
                        <h2 class="fw-bold">Manage Products</h2>
                    </div>
                    <div class="col-3 mt-4 mb-1 align-self-center" id="dashName">
                        <h4 class="text-light fs-5">Admin - <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                    </div>
                    <div class="col-12">
                        <hr />
                    </div>

                    <form action="addProduct.php">
                        <div class="col-12 mt-3">
                            <div class="row justify-content-end">
                                <div class="col-12 col-lg-4 mb-3 text-end">
                                    <div class="row">
                                        <div class="col-12 d-grid">
                                            <button class="btn btn-info fs-4 p-1" type="submit">Add New Book</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-primary bg-opacity-50 py-2 text-center">
                                <span class="fs-4 fw-bold text-white">#</span>
                            </div>
                            
                            <div class="col-6 col-lg-6 bg-white bg-opacity-50 py-2">
                                <span class="fs-4 fw-bold text-white">Title</span>
                            </div>
                            <div class="col-2 col-lg-3 bg-primary bg-opacity-50 py-2">
                                <span class="fs-4 fw-bold">Price</span>
                            </div>
                            <div class="col-2 bg-white bg-opacity-50 py-2">
                                <span class="fs-5 fw-bold text-white">Quantity</span>
                            </div>
                            
                        </div>
                    </div>

                    <?php


                    $query = "SELECT * FROM `product`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $product_rs = Connection::select($query);
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 10;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                    $selected_rs = Connection::select($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();
                    ?>
                        <!--  -->
                        <div class="col-12 mt-3 mb-1 shadow" data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo ($x) ?>" aria-expanded="false" aria-controls="collapseExample<?php echo ($x) ?>">
                            <div class=" row">
                                <div class="col-2 col-lg-1 bg-primary bg-opacity-50 py-2 text-center">
                                    <span class="fs-5 text-dark"><?php echo $x + 1; ?></span>
                                </div>

                                <div class="col-6 col-lg-6 bg-white bg-opacity-50 py-2">
                                    <?php 
                                if ($selected_data["status_status_id"] == 1) {
                                    ?>
                                        <span class="fs-5 fw-bold text-dark"><?php echo $selected_data["title"]; ?></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fs-5 fw-bold text-danger"><?php echo $selected_data["title"]; ?></span>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                                <div class="col-2 col-lg-3 bg-primary bg-opacity-50 py-2">
                                    <span class="fs-5 fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</span>
                                </div>
                                <div class="col-2 col-lg-2 bg-white bg-opacity-50 py-2">
                                    <span class="fs-5 fw-bold text-white"><?php echo $selected_data["qty"]; ?></span>
                                </div>

                            </div>

                        </div>
                        <!--  -->
                        <div class="collapse mb-2" id="collapseExample<?php echo ($x) ?>">
                            <div class="row justify-content-center">
                                <div class="col-4 bg-light bg-opacity-75 py-2">
                                    <?php
                                    $image_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                    $image_num = $image_rs->num_rows;

                                    if ($image_num == 0) {
                                    ?>
                                        <img src="resource/product_img/1.jpeg" style="height: 120px;margin-left: 40px;" />
                                    <?php
                                    } else {
                                        $image_data = $image_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $image_data["img_path"]; ?>" style="height: 120px;margin-left: 40px;" />
                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="col-8 bg-primary bg-opacity-50 py-2 text-center">
                                    <button onclick="viewProductModal('<?php echo $selected_data['id']; ?>');" class="btn btn-warning col-10 mb-3 mt-3">View Details</button>
                                    <button onclick="sendid(<?php echo $selected_data['id']; ?>);" class="btn btn-dark col-10 mb-3">Update</button>
                                    <?php

                                    if ($selected_data["status_status_id"] == 1) {
                                    ?>
                                        <button id="pb<?php echo $selected_data['id']; ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');" class="btn btn-danger col-10">Block</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button id="pb<?php echo $selected_data['id']; ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');" class="btn btn-success col-10">Unblock</button>
                                    <?php
                                    }
                                    ?>


                                </div>


                            </div>
                        </div>

                        <!-- modal 01 -->
                        <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data['id']; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #BA457C;">
                                        <h5 class="modal-title fw-bold text-light"><?php echo $selected_data['title']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="background-color: #c5e1fa;">
                                        <div class="offset-4 col-4">
                                            <?php
                                            $image_rs1 = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                            $image_num1 = $image_rs1->num_rows;
                                            if ($image_num1 == 0) {
                                            ?>
                                                <img src="resource/product_img/1.jpeg" class="img-fluid" style="height: 150px;" />
                                            <?php
                                            } else {
                                                $image_data1 = $image_rs1->fetch_assoc();
                                            ?>
                                                <img src="<?php echo $image_data1["img_path"]; ?>" class="img-fluid" style="height: 150px;" />
                                            <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="col-12">
                                            <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                            <span class="fs-5">Rs. <?php echo $selected_data['price']; ?> .00</span><br />
                                            <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                            <span class="fs-5"><?php echo $selected_data['qty']; ?> Products left</span><br />
                                            <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                            <?php
                                            $seller_rs = Connection::select("SELECT * FROM `admin` WHERE `email`='" . $selected_data['admin_email'] . "'");
                                            $seller_data = $seller_rs->fetch_assoc();
                                            ?>
                                            <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br />
                                            <span class="fs-5 fw-bold">Added Date - </span>
                                            <span class="fs-5"><?php echo $selected_data["datetime_added"]; ?></span><br />
                                            <span class="fs-5 fw-bold mt-3">Description :</span>&nbsp;
                                            <span class="fs-5"><?php echo $selected_data['description']; ?></span><br />
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="background-color: #BA457C;">
                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal 01 -->

                    <?php
                    }

                    ?>

                    <!--  -->
                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="
                            <?php if ($pageno <= 1) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno - 1);
                            } ?>
                            " aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php
                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>

                                <li class="page-item">
                                    <a class="page-link" href="
                            <?php if ($pageno >= $number_of_pages) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno + 1);
                            } ?>
                            " aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!--  -->

                    <hr />

                    <div class="col-12 text-center">
                        <h3 class="text-light fw-bold">Manage Categories</h3>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row gap-1 justify-content-center">

                            <?php
                            $category_rs = Connection::select("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <div class="col-12 col-lg-3 border border-warning rounded" style="height: 50px;">
                                    <div class="row">
                                        <div class="col-8 mt-2 mb-2">
                                            <label class="form-label fw-bold fs-5 text-light"><?php echo $category_data["cat_name"]; ?></label>
                                        </div>

                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="col-12 col-lg-3 border border-info rounded" style="height: 50px;" onclick="addNewCategory();">
                                <div class="row">
                                    <div class="col-8 mt-3 mb-2">
                                        <label class="form-label fw-bold text-light">Add new Category</label>
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <label class="form-label fs-4"><i class="bi bi-plus-square-fill text-info"></i></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- modal 2 -->
                    <div class="modal" tabindex="-1" id="addCategoryModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #BA457C;">
                                    <h5 class="modal-title">Add New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #c5e1fa;">
                                    <div class="col-12">
                                        <label class="form-label">New Category Name : </label>
                                        <input type="text" class="form-control" id="n" />
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label class="form-label">Enter Your Email : </label>
                                        <input type="text" class="form-control" id="e" value="<?php echo ($_SESSION["au"]["email"]) ?>" />
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #BA457C;">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 2 -->
                    <!-- modal 3 -->
                    <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #BA457C;">
                                    <h5 class="modal-title">Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #c5e1fa;">
                                    <div class="col-12 mt-3 mb-3">
                                        <label class="form-label">Enter Your Verification Code : </label>
                                        <input type="text" class="form-control" id="txt" />
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #BA457C;">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 3 -->

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