<?php
include "Database.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | Unicorn</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />

</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#79aaf7 0%,#0b244d 100%);">

    <div class="container-fluid">
        <div class="row gy-3">

            <?php

            if (isset($_SESSION["au"])) {
                if (isset($_SESSION["p"])) {


                    $product = $_SESSION["p"];

            ?>
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
                            <h2 class="fw-bold">Update Product</h2>
                        </div>
                        <div class="col-3 mt-4 mb-1 align-self-center" id="dashName">
                            <h4 class="text-light fs-5">Admin - <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Category</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php
                                                    $category_rs = Connection::select("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $category_data["cat_name"] ?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Publisher</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php
                                                    $publisher_rs = Connection::select("SELECT * FROM `publisher` WHERE `publisher_id` IN 
                                                    (SELECT `publisher_publisher_id` FROM `author_has_publisher` WHERE `id`='" . $product["author_has_publisher_id"] . "')");
                                                    $publisher_data = $publisher_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $publisher_data["publisher_name"] ?></option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Author</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>
                                                    <?php
                                                    $author_rs = Connection::select("SELECT * FROM `author` WHERE `author_id` IN 
                                                    (SELECT `author_author_id` FROM `author_has_publisher` WHERE `id`='" . $product["author_has_publisher_id"] . "')");
                                                    $author_data = $author_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $author_data["author_name"] ?></option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Product Title
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <input type="text" class="form-control" value="<?php echo $product["title"] ?>" id="t" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" disabled value="<?php echo $product["price"] ?>" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                            <div class="row">

                                                <div class="col-12 mb-1">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="number" class="form-control" value="<?php echo($product["qty"])?>" min="0" id="q" />
                                                </div>

                                            </div>
                                        </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-success">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost Within Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["delivery_fee_colombo"] ?>" id="dwc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["delivery_fee_other"] ?>" id="doc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="30" rows="15" class="form-control" id="d"><?php echo $product["description"] ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">

                                                <?php

                                                $img = array();

                                                $img[0] = "resource/addproductimg.jpg";
                                                $img[1] = "resource/addproductimg.jpg";
                                                $img[2] = "resource/addproductimg.jpg";

                                                $product_img_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                                $product_img_num = $product_img_rs->num_rows;

                                                for ($x = 0; $x < $product_img_num; $x++) {
                                                    $product_img_data = $product_img_rs->fetch_assoc();

                                                    $img[$x] = $product_img_data["img_path"];
                                                }


                                                ?>

                                                <div class="row">
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" id="i0" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px;" id="i1" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px;" id="i2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                                <input type="file" class="d-none" id="imageuploader" multiple />
                                                <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-success" />
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-dark" onclick="updateProduct();">Update Product</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 text-center text-black-50 mt-4 mb-2">
                        <label>unicorn.lk | Solution by Sandeepa&copy; <?php echo (date("Y")) ?></label>
                    </div>
                    </div>
                <?php
                } else {
                ?>
                    <script>
                        alert("Please select a product to update.");
                        window.location = "myProducts.php";
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("You have to signin to the system for access this function.");
                    window.location = "home.php";
                </script>
            <?php
            }

            ?>



            
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>