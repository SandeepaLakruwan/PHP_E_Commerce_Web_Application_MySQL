<?php

include "Database.php";
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Unicorn</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />

</head>

<body style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <hr />

            <div class="col-12 justify-content-center">
                <div class="row mb-1">

                    <div class="offset-4 offset-lg-1 col-lg-6"></div>

                    <div class="col-12 col-lg-4">

                        <div class="input-group mt-1 mb-1">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="form-select" style="max-width: 150px;" id="basic_search_select">
                                <option value="0">All Categories</option>
                                <?php

                                $category_rs = Connection::select("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>
                                <?php
                                }

                                ?>
                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-1 d-grid">
                        <button class="btn btn-primary mt-1 mb-1" onclick="basicSearch(0);"><i class="bi bi-search"></i></button>
                    </div>

                </div>
            </div>

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">

                    <!-- Carousel -->

                    <div class="col-12 d-none d-lg-block mb-3">
                        <div class="row">

                            <div id="carouselExampleIndicators" class="offset-2 col-8 carousel slide" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resource/slider_images/img1.jpg" class="d-block img-thumbnail poster-img-1" />
                                        <div class="carousel-caption d-none d-md-block poster-caption">
                                            <h5 class="poster-title">Welcome to Unicorn</h5>

                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider_images/img2.jpg" class="d-block img-thumbnail poster-img-1" />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider_images/img3.jpg" class="d-block img-thumbnail poster-img-1" />
                                        <div class="carousel-caption d-none d-md-block poster-caption-1">

                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- Carousel -->

                    <div class="col-12 mt-3 mb-3" style="background-color: #BA457C;">
                        <div class="row">
                            <div class="col-4 text-center">
                                <p class="text-white mt-2">Seasonal Offer</p>
                                <h1 class="text-white">20% OFF</h1>
                                <p class="text-white mt-2">On selected books</p>
                            </div>
                            <div class="col-4 text-center">
                                <p class="text-white mt-2 fs-4">Don't miss such a deal</p>
                                <button class="btn btn-light fw-bold p-3">Shop Now</button>
                            </div>
                            <div class="col-4 text-center">
                                <img src="resource/books.jpeg" style="height:100px" class="mt-3" />
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mt-5">
                        <div class="row">
                            <div class="col-6 text-center" style="background-color:#45B7BA;">
                                <image src="resource/join.jpg" class="img4" />
                            </div>
                            <div class="col-6 text-center" style="background-color:#45B7BA;">
                                <h1 class="text-center mt-5 slide-left">Join With Us</h1>
                                <h1 class="text-center slide-left">For Better Price</h1>
                                <form action="http://localhost/bookshop/signUp.php">
                                    <button class="btn btn-danger mb-5 mt-5 button fs-2 slide-left" type="submit">
                                        Sign Up Here
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5 mb-5" id="test">
                        <div class="row">

                            <div class="col-12 text-center text-black mt-3 mb-3">
                                <h1>Categories</h1>
                            </div>

                            <?php

                            $category_rs1 = Connection::select("SELECT * FROM `category`");
                            $category_num1 = $category_rs1->num_rows;

                            for ($x = 0; $x < $category_num1; $x++) {
                                $category_data1 = $category_rs1->fetch_assoc();
                            ?>
                                <div class="col-4 text-center mt-4 mb-3 slide-bottom" id="<?php echo $category_data1["cat_id"]; ?>">
                                    <image src="resource/category.png" class="image3" />
                                    <label class="fs-5 text-black-50"><?php echo $category_data1["cat_name"]; ?></label>
                                </div>
                            <?php
                            }

                            ?>

                        </div>
                    </div>


                    <?php
                    $category_rs2 = Connection::select("SELECT * FROM `category`");
                    $category_num2 = $category_rs2->num_rows;

                    for ($y = 0; $y < $category_num2; $y++) {
                        $category_data2 = $category_rs2->fetch_assoc();
                    ?>
                        <!-- Category Name -->

                        <div class="col-12 mt-3 mb-3">
                            <a href='categoryView.php?id=<?php echo $category_data2["cat_id"]; ?>' class="text-decoration-none text-success fs-3 fw-bold">
                                <?php echo $category_data2["cat_name"]; ?>
                            </a> &nbsp;&nbsp;
                            <a href="categoryView.php?id=<?php echo $category_data2["cat_id"]; ?>" class="text-decoration-none text-danger fs-6">See All &nbsp;&rarr;</a>
                        </div>

                        <!-- Category Name -->
                        <!-- products -->

                        <div class="col-12 mb-3">
                            <div class="row border border-primary">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-2">

                                        <?php

                                        $product_rs = Connection::select("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data2["cat_id"] . "' 
                                    AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                        $product_num = $product_rs->num_rows;

                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();
                                        ?>

                                            <div class="card col-6 col-lg-2 mt-2 mb-2 bg-primary bg-opacity-50 shadow" style="width: 18rem;">

                                                <?php
                                                $img_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                                ?>

                                                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                                    <span class="badge rounded-pill text-bg-info">New</span><br />
                                                    <span class="card-text text-black fs-4">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                                    <?php
                                                    if ($product_data["qty"] > 0) {

                                                    ?>
                                                        <span class="card-text text-light fw-bold bg-success p-1 m-1">In Stock</span><br />
                                                        <span class="card-text text-light fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                        <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-dark">
                                                            Buy Now
                                                        </a>
                                                        <button class="col-6 btn btn-warning mt-2">
                                                            <i class="bi bi-cart-plus-fill text-white fs-5" onclick="addToCart(<?php echo $product_data['id']; ?>);"></i>
                                                        </button>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <span class="card-text text-danger fw-bold">Out Of Stock</span><br />
                                                        <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                                                        <a href='#' class="col-12 btn btn-dark disabled">
                                                            Buy Now
                                                        </a>
                                                        <button class="col-6 btn btn-warning mt-2 disabled">
                                                            <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                        </button>
                                                        <?php
                                                    }

                                                    if (isset($_SESSION["i"])) {

                                                        $watchlist_rs = Connection::select("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["i"]["email"] . "' 
                                                            AND `product_id`='" . $product_data["id"] . "'");
                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                        if ($watchlist_num == 1) {
                                                        ?>
                                                            <button class="col-5 btn btn-success mt-2 border border-primary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                <i class="bi bi-bookmarks-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="col-5 btn btn-success mt-2 border border-primary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                <i class="bi bi-bookmarks-fill text-dark fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                            </button>
                                                    <?php
                                                        }
                                                    }


                                                    ?>



                                                </div>
                                            </div>

                                        <?php
                                        }

                                        ?>



                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- products -->
                    <?php
                    }

                    ?>




                </div>
            </div>
            <div class="message-icon" data-bs-toggle="modal" data-bs-target="#contactAdmin" onclick="loadChat();">
                        <img src="resource/comments.png" style="height:50px;"/>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="jquery.js"></script>
    <script src="jquery.fadethis.js"></script>
    <script src="script.js"></script>

</body>

</html>