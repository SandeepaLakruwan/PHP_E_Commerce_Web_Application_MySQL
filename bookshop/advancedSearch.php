<?php
    include "Database.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | Unicorn</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />

</head>

<body style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">

    <div class="container-fluid bg-info bg-opacity-25">
        <div class="row">
            
                <?php include "header.php"; ?>

            <div class="col-12 mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            
                            <div class="col-12 text-center d-flex mt-4 mb-3">
                                <img src="resource/advanced-search.png" />
                                <P class="fs-1 text-black fw-bold mt-3 pt-2">Advanced Search</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 mb-3 bg-body rounded bg-primary bg-opacity-50">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 mb-1">
                                <input type="text" class="form-control" placeholder="Type keyword to search..." id="t"/>
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn btn-primary" onclick="advancedSearch(0);"><i class="bi bi-search fs-6"></i></button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-3 border-primary">
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
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

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="b1">
                                            <option value="0">Select Publisher</option>
                                            <?php
                                                $pub_rs = Connection::select("SELECT * FROM `publisher`");
                                                $pub_num = $pub_rs->num_rows;

                                                for ($x = 0; $x < $pub_num; $x++) {
                                                    $pub_data = $pub_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $pub_data["publisher_id"]; ?>">
                                                        <?php echo $pub_data["publisher_name"]; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Author</option>
                                            <?php
                                                $author_rs = Connection::select("SELECT * FROM `author`");
                                                $author_num = $author_rs->num_rows;

                                                for ($x = 0; $x < $author_num; $x++) {
                                                    $author_data = $author_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $author_data["author_id"]; ?>">
                                                        <?php echo $author_data["author_name"]; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3 bg-primary bg-opacity-75">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><img src="resource/shopping.png"/></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>