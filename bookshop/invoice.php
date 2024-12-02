<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | Unicorn</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />
</head>

<body class="mt-2" style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">

    <div class="container-fluid">
        <div class="row">
            <?php 
            include "Database.php";
            include "header.php";

            

            if (isset($_SESSION["i"])) {
                $umail = $_SESSION["i"]["email"];
                $oid = $_GET["id"];

            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2 col-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-6">
                            <div class="ms-5 invoiceHeaderImage"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-light text-decoration-underline text-end">
                                    <h2>Unicorn Bookshop</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Maradana, Colombo 10, Sri Lanka.</span><br />
                                    <span>+94112 555448</span><br />
                                    <span>unicorn@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-dark" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">

                            <?php

                            $address_rs = Connection::select("SELECT * FROM `user_has_address` WHERE `user_email`='".$umail."'");
                            $address_data = $address_rs->fetch_assoc();
                            
                            ?>

                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <h2><?php echo $_SESSION["i"]["fname"]." ".$_SESSION["i"]["lname"]; ?></h2>
                                    <span><?php echo $address_data["line1"]." ".$address_data["line2"]; ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>

                                <?php 

                                $invoice_rs = Connection::select("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
                                $invoice_data = $invoice_rs->fetch_assoc();
                                
                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-light">INVOICE <?php echo $invoice_data["invoice_id"]; ?></h1>
                                    <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-success text-dark fs-3"><?php echo $invoice_data["invoice_id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-dark text-decoration-underline p-2"><?php echo $oid; ?></span><br />
                                            <?php

                                            $product_rs = Connection::select("SELECT * FROM `product` WHERE `id`='".$invoice_data["product_id"]."'");
                                            $product_data = $product_rs->fetch_assoc();
                                            
                                            ?>
                                            <span class="fw-bold text-dark fs-3 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-success text-dark">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="fw-bold fs-6 text-end pt-3"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-success text-dark">Rs. <?php echo ($product_data["price"]*$invoice_data["qty"]); ?> .00</td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                <?php

                                $city_rs = Connection::select("SELECT * FROM `city` WHERE `city_id`='".$address_data["city_city_id"]."'");
                                $city_data = $city_rs->fetch_assoc();

                                $delivery = 0;

                                if($city_data["district_district_id"] == 1){
                                    $delivery = $product_data["delivery_fee_colombo"];
                                }else{
                                    $delivery = $product_data["delivery_fee_other"];
                                }

                                $t = $invoice_data["total"];
                                $g = $t - $delivery;
                                
                                ?>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $g; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-light">Delivery Fee</td>
                                        <td class="text-end border-light">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-light text-light">GRAND TOTAL</td>
                                        <td class="fs-5 text-end fw-bold border-light text-light">Rs. <?php echo $t; ?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-success">Thank You !</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-primary rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                    <br />
                                    <label class="form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>

            <?php
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>