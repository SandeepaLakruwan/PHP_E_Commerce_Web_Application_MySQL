<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="col-12 bg-black">
        <div class="row mt-1 mb-1 pt-1 pb-1">

            <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-2 d-flex">
                <img src="logo.jpg" style="height: 60px;" />
                <div class="row">
                    <div class="d-flex">
                        <p class="title01 text-white align-self-center mt-2">UNICORN </p><br />
                        <p class="text-white-50 align-self-center"> BOOKSHOP</p>
                    </div>
                </div>

            </div>

            <div class="col-12 col-lg-5 align-self-center">
                <a href="home.php" class="text-info fs-5 m-3 text-decoration-none">Home</a>
                <a href="aboutus.php" class="text-info fs-5 m-3 text-decoration-none">About Us</a>
                <select class="btn btn-outline-info m-3" style="max-width: 150px;" id="catogory" onchange="searchCatogory();">
                    <option value="0">Categories</option>
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
                <a href="advancedSearch.php" class="text-info m-3 text-decoration-none">Advance Search</a>

                <?php
                session_start();
                if (isset($_SESSION["i"])) {
                    $email = $_SESSION["i"]["email"];
                    $msgcount_rs = Connection::select("SELECT COUNT(`chat_id`) AS `count` FROM `chat` WHERE `status`='3'");
                    $msgcount_data = $msgcount_rs->fetch_assoc();

                    if ($msgcount_data["count"] != "0") {
                ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-arrow-down-fill text-danger" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zm.192 8.159 6.57-4.027L8 9.586l1.239-.757.367.225A4.49 4.49 0 0 0 8 12.5c0 .526.09 1.03.256 1.5H2a2 2 0 0 1-1.808-1.144M16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z" />
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.354-1.646a.5.5 0 0 1-.722-.016l-1.149-1.25a.5.5 0 1 1 .737-.676l.28.305V11a.5.5 0 0 1 1 0v1.793l.396-.397a.5.5 0 0 1 .708.708z" />
                        </svg>
                <?php
                    }
                }
                ?>


            </div>


            <?php

            if (isset($_SESSION["i"])) {
                if (isset($_COOKIE["name"])) {
                    $name = $_COOKIE["name"];
            ?>




                    <div class="col-12 col-lg-3 align-self-center">
                        <div class="row">


                            <div class="col-10 col-lg-9 dropdown d-flex justify-content-end">
                                <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span class="text-lg-start text-white"><b>Hi </b><?php echo $name; ?></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                                    <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                    <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#contactAdmin" onclick="loadChat();">Messages</a></li>
                                    <li><span class="dropdown-item" onclick="signout();">Signout</span></li>
                                </ul>

                            </div>
                            <div class="col-1 col-lg-2 ms-5 ms-lg-0 cart-icon btn btn-info" onclick="window.location='cart.php'"><i class="bi bi-bag-check"></i></div>
                        </div>
                    </div>

                    <!-- msg modal -->
                    <div class="modal" tabindex="-1" id="contactAdmin">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #BA457C;">
                                    <h5 class="modal-title">Messages</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload();"></button>
                                </div>
                                <div class="modal-body overflow-scroll modal-body-scroll" id="message_body" style="background-color: #c5e1fa;">



                                </div>
                                <div class="modal-footer" style="background-color: #BA457C;">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="msgtxt" />
                                            </div>
                                            <div class="col-3 d-grid">
                                                <button type="button" class="btn btn-primary" onclick="saveMessage();">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->



                <?php
                }
            } else {
                ?>
                <div class="col-12 col-lg-3 align-self-center text-center mt-2">
                    <a href="signIn.php" class="text-decoration-none fw-bold text-white">Sign In or Register</a>
                    <!-- <a href="#" class="text-lg-start fw-bold text-white-50 text-decoration-none">| <i class="bi bi-info-circle"></i>Help and Contact</a> -->
                </div>
            <?php
            }
            ?>



        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>