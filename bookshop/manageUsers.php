<?php

require "Database.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | Unicorn</title>

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
                                    <a class="nav-link active" href="manageUsers.php">Manage Users</a>
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
                        <h2 class="fw-bold">Manage Users</h2>
                    </div>
                    <div class="col-3 mt-4 mb-1 align-self-center" id="dashName">
                        <h4 class="text-light fs-5">Admin - <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                    </div>
                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 pt-2 pb-2 bg-white bg-opacity-25 shadow">
                        <div class="row">
                            <div class="col-2 text-center">
                                <label class="fs-5 text-black-50 text-break">#</label>
                            </div>
                            <div class="col-4">
                                <label class="fs-5 text-success text-break">Name</label>
                            </div>
                            <div class="col-6">
                                <label class="fs-5 text-black text-break">Email</label>
                            </div>

                        </div>
                    </div>

                    <?php

                    $query = "SELECT * FROM `user`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $user_rs = Connection::select($query);
                    $user_num = $user_rs->num_rows;

                    $results_per_page = 20;
                    $number_of_pages = ceil($user_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                    $selected_rs = Connection::select($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                    ?>
                        <div class="col-12 mt-3 mb-1 shadow" data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo ($x) ?>" aria-expanded="false" aria-controls="collapseExample<?php echo ($x) ?>">
                            <div class=" row">
                                <div class="col-2 col-lg-2 bg-light bg-opacity-50 py-2 text-center">
                                    <span class="fs-5 text-dark"><?php echo $x + 1; ?></span>
                                </div>

                                <?php
                                $umail = $selected_data["email"];
                                $isMsg_rs = Connection::select("SELECT COUNT(`chat_id`) AS `count` FROM `chat` WHERE `from`='" . $umail . "' AND `status`='1'");
                                $isMsg_num = $isMsg_rs->num_rows;
                                $isMsg_data = $isMsg_rs->fetch_assoc();
                                ?>

                                <div class="col-4 col-lg-4 bg-light bg-opacity-50 py-2">
                                    <span class="fs-5 text-dark text-break"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                                    <?php 
                                        if($isMsg_data["count"] != "0"){
                                            ?>
                                                <span class="text-danger"><i class="bi bi-envelope-fill text-danger"></i>  <?php echo $isMsg_data["count"]?></span>
                                            <?php 
                                        }
                                    ?>
                                </div>
                                <div class="col-6 col-lg-6 bg-light bg-opacity-50 py-2">
                                    <span class="fs-5 text-break"><?php echo $selected_data["email"]; ?></span>
                                </div>

                            </div>

                        </div>
                        <!--  -->
                        <div class="collapse mb-2" id="collapseExample<?php echo ($x) ?>">
                            <div class="row justify-content-center">
                                <div class="col-3 bg-light bg-opacity-75 pt-3 pb-3">
                                    <?php
                                    $profile_img_rs = Connection::select("SELECT * FROM `profile_img` WHERE 
                                    `user_email`='" . $selected_data["email"] . "'");
                                    $profile_img_num = $profile_img_rs->num_rows;

                                    if ($profile_img_num == 1) {
                                        $profile_img_data = $profile_img_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $profile_img_data["path"]; ?>" style="height: 120px;margin-left: 40px;" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resource/new_user.svg" style="height: 120px;margin-left: 40px;" />
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-5 d-none d-lg-block bg-light bg-opacity-75 py-2 text-center">

                                    <span class="fs-5 text-dark text-break">Name - <?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span></br>
                                    <span class="fs-5 text-break">Email - <?php echo $selected_data["email"]; ?></span></br>
                                    <span class="fs-5 text-dark text-break">Mobile - <?php echo $selected_data["mobile"]; ?></span></br>
                                    <?php
                                    $splitDate = explode(" ", $selected_data["joined_date"]);
                                    ?>
                                    <span class="fs-5 text-break">Register Date - <?php echo $splitDate[0]; ?></span>
                                </div>
                                <div class="col-4 d-none d-lg-block bg-primary bg-opacity-50 py-2">

                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-10 py-2 d-grid">
                                            <button id="ub<?php echo $selected_data["email"]; ?>" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');" class="btn btn-warning mb-4 mt-3">Message</button>
                                            <?php
                                            if ($selected_data["status_status_id"] == 1) {
                                            ?>
                                                <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="btn btn-danger">Block</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="btn btn-success">Unblock</button>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- msg modal -->
                        <div class="modal" tabindex="-1" id="contactAdmin<?php echo $selected_data["email"]; ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #BA457C;">
                                        <h5 class="modal-title">Messages</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
                                    </div>
                                    <div class="modal-body overflow-scroll modal-body-scroll" id="message_body<?php echo $selected_data["email"]; ?>" style="background-color: #c5e1fa;">



                                    </div>
                                    <div class="modal-footer" style="background-color: #BA457C;">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="msgtxt<?php echo $selected_data["email"]; ?>" />
                                                </div>
                                                <div class="col-3 d-grid">
                                                    <button type="button" class="btn btn-primary" onclick='sendAdminMsg("<?php echo $selected_data["email"]; ?>");'>Send</button>
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