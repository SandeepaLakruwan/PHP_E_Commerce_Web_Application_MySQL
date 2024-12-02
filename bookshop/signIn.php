<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign In</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="logo.jpg" />

</head>

<body class="bg-primary bg-opacity-25" style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">
    <!-- Register process -->
    <!-- In here user can send request to create account -->

    <?php
    session_start();
    require 'Database.php';
    if (isset($_COOKIE['email'])) {
        $email = $_COOKIE['email'];
    }
    if (isset($_COOKIE['password'])) {
        $password = $_COOKIE['password'];
    }
    ?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 mt-3 justify-content-center">
                <div class="mt-3 m-2 p-2 bg-primary bg-opacity-75 text-black col-12 rounded-3">
                    <img src="logo.jpg" class="logo" />
                    <label class="fs-2">Unicorn Book Shop</label>
                </div>


                <div class="rounded-3 shadow-lg m-2 mt-3 col-lg-12 d-none d-lg-block">
                    <img src="register.jpg" class="register bg-opacity-25" />
                </div>



            </div>
            <div class="col-12 col-lg-8 mt-2 justify-content-center mb-2">
                <div class="row mt-4">
                    <div class="col-12 d-none d-lg-block">
                        <p></p>
                    </div>
                    <div class="col-2">
                        <p></p>
                    </div>
                    <div class="col-8 d-block shadow align-items-center bg-primary bg-opacity-25 rounded-3 mt-2">

                        <div class="row">

                            <div class="col-12 mt-2 rounded-3 text-center">
                                <img src="resource/permission.png"/>
                                <h2 class="text-light text-center">Sign In</h2>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label text-black">Email</label>
                                <input value="<?php if (isset($email)) {
                                                    echo ($email);
                                                } ?>" type="text" class="form-control" id="email" />
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label text-black">Password</label>
                                <input value="<?php if (isset($password)) {
                                                    echo ($password);
                                                } ?>" type="password" class="form-control" id="password" />
                            </div>

                            <div class="form-check col-12 m-3">
                                <input checked class="form-check-input" type="checkbox" id="rememberme">
                                <label for="rememberme" class="form-check-label text-light">Remember Me</label>
                            </div>

                            <div class="col-12 text-center mt-2 bg-white bg-opacity-25 shadow text-danger fs-5 mb-2" id="message">

                            </div>

                            <div class="d-grid col-12">
                                <button class="btn btn-primary" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="d-grid mt-2 mb-2 col-12 col-lg-6 text-start">
                                <!-- send request to create account and it will store in a request table while officer accept it -->
                                <a class="text-light col-12" href="signUp.php"> Haven't account? Sign Up</a>
                            </div>
                            <div class="d-grid mt-2 mb-2 col-12 col-lg-6 text-end">

                                <a class="text-light col-12" href="#" onclick="forgotPassword();"> Forget Password?</a>
                            </div>

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal" tabindex="-1" role="dialog" id="fpmodal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #BA457C;">
                                    <h5 class="modal-title">Forgot Password</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="background-color: #c5e1fa;">
                                    <div class="row g-3">

                                        <div class="col-6">
                                            <label class="form-label">New Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="np">
                                                <div class="input-group-append">
                                                    <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
                                                </div>

                                            </div>

                                            <label class="form-label">Re-type Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="rnp">
                                                <div class="input-group-append">
                                                    <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                                                </div>

                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Verification Code</label>
                                                <input type="text" class="form-control" id="vcode" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #BA457C;">
                                    <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal end -->

                    <div class="col-lg-12 text-center text-black-50 mt-4 mb-2">
                        <label>unicorn.lk | Solution by Sandeepa&copy; <?php echo (date("Y")) ?></label>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>