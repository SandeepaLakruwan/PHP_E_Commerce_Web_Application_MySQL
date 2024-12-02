<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign Up</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="logo.jpg" />

</head>

<body class="bg-primary bg-opacity-25" style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">
    <!-- Register process -->
    <!-- In here user can send request to create account -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 mt-3 justify-content-center">
                <div class="mt-3 m-2 p-2 bg-primary bg-opacity-75 text-black col-12 rounded-3">
                    <img src="logo.jpg" class="logo"/>
                    <label class="fs-2">Unicorn Book Shop</label>
                </div>


                <div class="rounded-3 shadow-lg m-2 mt-3 d-none d-lg-block">
                    <img src="register.jpg" class="register bg-opacity-25" />
                </div>

                <div class="col-12 text-center text-black-50 mt-4 mb-2">
                    <label>unicorn.lk | Solution by Sandeepa&copy; <?php echo(date("Y"))?></label>
                </div>

            </div>
            <div class="col-12 col-lg-8 mt-5 justify-content-center">
                <div class="row">

                    <div class="col-1"></div>
                    <div class="col-10 d-block shadow align-items-center bg-primary bg-opacity-25 rounded-3 mt-2 mb-2">

                        <div class="row">

                            <div class="col-12 mt-2 rounded-3">
                                <h2 class="text-black text-center">Sign Up</h2>
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label text-black">First Name</label>
                                <input type="text" class="form-control" id="fname" />
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label text-black">Last Name</label>
                                <input type="text" class="form-control" id="lname" />
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label text-black">Email</label>
                                <input type="email" class="form-control" id="email" />
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label text-black">Mobile</label>
                                <input type="text" class="form-control" id="mobile" />
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label text-black">Password</label>
                                <input type="password" class="form-control" id="password" />
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label text-black">Re-enter Password</label>
                                <input type="password" class="form-control" id="password2" />
                            </div>

                            
                            <div class="form-group col-12 col-lg-6 mt-2">
                                <label for="inputState" class="text-black">Gender</label>
                                <select class="form-control" id="gender">
                                    <option selected value="0">Choose...</option>
                                    <?php 
                                    include "Database.php";
                                    
                                    $table = Connection::select("SELECT * FROM `gender`");

                                    for ($i=0; $i < $table->num_rows; $i++) { 
                                        # code...
                                        $row = $table->fetch_assoc();

                                        ?>
                                    <option value="<?php echo($row["gender_id"])?>">
                                        <?php echo($row["gender_name"])?>
                                    </option>
                                    <?php
                                    }
                                ?>
                                </select>
                            </div>

                            <div class="col-12 text-center mt-2 bg-white bg-opacity-25 shadow text-danger fs-5" id="message">

                            </div>

                            <div class="d-grid mt-2 col-12">
                                <button class="btn btn-danger" onclick="register();">Register</button>
                            </div>
                            <div class="d-grid mt-2 mb-2 col-12 text-center">
                                <!-- send request to create account and it will store in a request table while officer accept it -->
                                <a class="text-light col-12" href="signIn.php"> Already Registered? Sign In</a>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>