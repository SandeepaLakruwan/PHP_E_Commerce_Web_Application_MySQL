<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin SignIn | Unicorn</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />
</head>

<body style="background-color: #79aaf7;background-image: linear-gradient(90deg,#79aaf7 0%,#0b244d 100%);">

    <div class="container-fluid justify-content-center" style="margin-top: 20px;">
        <div class="row align-content-center">

            <div class="col-12 col-lg-4 mt-3 justify-content-center">
                <div class="mt-3 m-2 p-2 bg-primary bg-opacity-75 text-black col-12 rounded-3">
                    <img src="logo.jpg" class="logo" />
                    <label class="fs-2">Unicorn Book Shop</label>
                </div>


                <div class="rounded-3 shadow-lg m-2 mt-3 col-lg-12 d-none d-lg-block">
                    <img src="register.jpg" class="register bg-opacity-25" />
                </div>

            </div>
            <!--  -->
            <div class="col-12 col-lg-8 mt-4 justify-content-center mb-2">
                <div class="row mt-4">
                    <div class="col-12 mt-4 mb-4 d-none d-lg-block">
                        <p></p>
                    </div>
                    <div class="col-2">
                        <p></p>
                    </div>
                    <div class="col-8 d-block shadow align-items-center bg-primary bg-opacity-25 rounded-3 mt-1 p-4">

                        <div class="row">

                            <div class="col-12 text-center">
                                <img src="resource/permission.png"/>
                                <p class="title02">Sign In to your Account.</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex : admin@gmail.com" id="e" />
                            </div>

                            <div class="col-12 text-center mt-2 bg-white bg-opacity-25 shadow text-danger fs-5 mb-2" id="message">

                            </div>

                            <div class="col-12 col-lg-6 d-grid mb-5">
                                <button class="btn btn-primary" onclick="adminVerification();">Send Verification Code</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mb-5">
                                <a class="btn btn-danger" href="signIn.php">Back to Customer Log In</a>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 text-center text-black-50 mt-4 mb-2">
                        <label>unicorn.lk | Solution by Sandeepa&copy; <?php echo (date("Y")) ?></label>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #BA457C;">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: #c5e1fa;">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer" style="background-color: #BA457C;">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>