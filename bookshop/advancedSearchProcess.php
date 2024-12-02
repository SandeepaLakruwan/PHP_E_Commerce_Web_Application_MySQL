<?php
session_start();
include "Database.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$pub = $_POST["b"];
$author = $_POST["m"];

$query = "SELECT * FROM `product`";
$status = 0;



if (!empty($search_txt)) {
    $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
    $status = 1;
}

if ($category != 0 && $status == 0) {
    $query .= " WHERE `category_cat_id`='" . $category . "'";
    $status = 1;
} else if ($category != 0 && $status != 0) {
    $query .= " AND `category_cat_id`='" . $category . "'";
}

$pid = 0;
if ($pub != 0 && $author == 0) {
    $author_has_pub_rs = Connection::select("SELECT * FROM `author_has_publisher` WHERE `publisher_publisher_id`='" . $pub . "'");
    $author_has_pub_num = $author_has_pub_rs->num_rows;
    for ($x = 0; $x < $author_has_pub_num; $x++) {
        $author_has_pub_data = $author_has_pub_rs->fetch_assoc();
        $pid = $author_has_pub_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `author_has_publisher_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `author_has_publisher_id`='" . $pid . "'";
    }
}

if ($pub == 0 && $author != 0) {
    $author_has_pub_rs = Connection::select("SELECT * FROM `author_has_publisher` WHERE `author_author_id`='" . $author . "'");
    $author_has_pub_num = $author_has_pub_rs->num_rows;
    for ($x = 0; $x < $author_has_pub_num; $x++) {
        $author_has_pub_data = $author_has_pub_rs->fetch_assoc();
        $pid = $author_has_pub_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `author_has_publisher_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `author_has_publisher_id`='" . $pid . "'";
    }
}

if ($pub != 0 && $author != 0) {
    $author_has_pub_rs = Connection::select("SELECT * FROM `author_has_publisher` WHERE `publisher_publisher_id`='" . $pub . "' 
        AND `author_author_id`='" . $author . "'");

    $author_has_pub_num = $author_has_pub_rs->num_rows;
    for ($x = 0; $x < $author_has_pub_num; $x++) {
        $author_has_pub_data = $author_has_pub_rs->fetch_assoc();
        $pid = $author_has_pub_data["id"];
    }

    if ($status == 0) {
        $query .= " WHERE `author_has_publisher_id`='" . $pid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= " AND `author_has_publisher_id`='" . $pid . "'";
    }
}

?>

<!-- <div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row"> -->

<?php

$pageno;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Connection::select($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Connection::select($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;
for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();
?>
    <div class="offset-lg-1 col-12 col-lg-3">
        <div class="row">

            <div class="card col-6 col-lg-2 mt-2 mb-2 bg-primary bg-opacity-50 shadow" style="width: 18rem;">

                <?php
                $img_rs = Connection::select("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $img_data = $img_rs->fetch_assoc();
                ?>

                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 140px;" />
                <div class="card-body ms-0 m-0 text-center">
                    <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                    <span class="badge rounded-pill text-bg-info">New</span><br />
                    <span class="card-text text-black fs-4">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />

                    <?php
                    if ($selected_data["qty"] > 0) {

                    ?>
                        <span class="card-text text-light fw-bold bg-success p-1 m-1">In Stock</span><br />
                        <span class="card-text text-light fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br /><br />
                        <a href='<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>' class="col-12 btn btn-dark">
                            Buy Now
                        </a>
                        <button class="col-6 btn btn-warning mt-2">
                            <i class="bi bi-cart-plus-fill text-white fs-5" onclick="addToCart(<?php echo $selected_data['id']; ?>);"></i>
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

                        $watchlist_rs = Connection::select("SELECT * FROM `watchlist` WHERE `user_email`='" . $_COOKIE["email"] . "' 
            AND `product_id`='" . $selected_data["id"] . "'");
                        $watchlist_num = $watchlist_rs->num_rows;

                        if ($watchlist_num == 1) {
                        ?>
                            <button class="col-5 btn btn-success mt-2 border border-primary" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                <i class="bi bi-bookmarks-fill text-danger fs-5" id="heart<?php echo $selected_data["id"]; ?>"></i>
                            </button>
                        <?php
                        } else {
                        ?>
                            <button class="col-5 btn btn-success mt-2 border border-primary" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'>
                                <i class="bi bi-bookmarks-fill text-dark fs-5" id="heart<?php echo $selected_data["id"]; ?>"></i>
                            </button>
                    <?php
                        }
                    }


                    ?>



                </div>
            </div>

        </div>
    </div>

<?php
}
?>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>