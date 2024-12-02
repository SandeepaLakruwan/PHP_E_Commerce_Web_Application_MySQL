<?php

include "Database.php";

if (isset($_GET["id"])) {

    $cid = $_GET["id"];

    $category_rs3 = Connection::select("SELECT * FROM `category` WHERE `cat_id`='" . $cid . "'");
    $category_data3 = $category_rs3->fetch_assoc();
?>

    <!DOCTYPE html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $category_data3["cat_name"] ?> | Unicorn</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="logo.jpg" />

    </head>

    <body style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);" onload="basicSearch(0);">

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

                                <select class="form-select" style="max-width: 150px;" id="basic_search_select" disabled>
                                    <option value="<?php echo $category_data3["cat_id"] ?>"><?php echo $category_data3["cat_name"] ?></option>

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
                        



                    </div>
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
<?php
} else {
    echo ("Something Went Wrong.");
}
?>