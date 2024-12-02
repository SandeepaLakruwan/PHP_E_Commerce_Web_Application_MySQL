$(document).ready(function () {

    $(window).fadeThis();

});

function register() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var mobile = document.getElementById("mobile").value;
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    var gender = document.getElementById("gender").value;

    var form = new FormData();
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("email", email);
    form.append("mobile", mobile);
    form.append("password", password);
    form.append("password2", password2);
    form.append("gender", gender);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            document.getElementById("message").innerHTML = request.responseText;

            if (request.responseText == "success") {
                window.location = 'signIn.php';
            }
            // alert(request.responseText);
        }

    };
    request.open("POST", "process_register.php", true);
    request.send(form);
}

function signIn() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var rememberMe = document.getElementById("rememberme").checked;

    var form = new FormData();
    form.append("email", email);
    form.append("password", password);
    form.append("remember", rememberMe);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var t = request.responseText;
            if (t == "student") {
                window.location = "home.php";
            } else {
                // alert(t);
                document.getElementById("message").innerHTML = t;
            }

            // alert(request.responseText);
        }

    };
    request.open("POST", "process_signIn.php", true);
    request.send(form);
}

function forgotPassword() {

    var email = document.getElementById("email");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var text = request.responseText;
            // alert(text);

            if (text == "Success") {
                alert("Verification code has sent succesfully. Please check your Email.");
                var modal = document.getElementById("fpmodal");
                forgotPasswordModal = new bootstrap.Modal(modal);
                forgotPasswordModal.show();
            } else {
                document.getElementById("message").innerHTML = text;
                // document.getElementById("msgdiv1").className = "d-block";

            }

        }
    }

    request.open("GET", "fotgotPasswordProcess.php?e=" + email.value, true);
    request.send();
}

function showPassword1() {

    var textfield = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
    } else {
        textfield.type = "password";
        button.innerHTML = "<i class='bi bi-eye-fill'></i>";
    }

}

function showPassword2() {

    var textfield = document.getElementById("rnp");
    var button = document.getElementById("rnpb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
    } else {
        textfield.type = "password";
        button.innerHTML = "<i class='bi bi-eye-fill'></i>";
    }

}

function resetPassword() {

    var email = document.getElementById("email");
    var newPassword = document.getElementById("np");
    var retypePassword = document.getElementById("rnp");
    var verification = document.getElementById("vcode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", newPassword.value);
    form.append("r", retypePassword.value);
    form.append("v", verification.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {

                alert("Password updated successfully.");
                forgotPasswordModal.hide();

            } else {

                alert(response);

            }
        }
    }

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);
}

function signout() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location.reload();
            }
        }
    }

    request.open("GET", "signOutProcess.php", true);
    request.send();

}

function basicSearch(x) {

    var txt = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");

    var form = new FormData();
    form.append("t", txt.value);
    form.append("s", select.value);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("basicSearchResult").innerHTML = response;
        }
    }

    request.open("POST", "basicSearchProcess.php", true);
    request.send(form);

}

var av;
function adminVerification() {

    var email = document.getElementById("e");

    var form = new FormData();
    form.append("e", email.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Success") {
                alert("Please take a look at your email to find the VERIFICATION CODE.");
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "adminVerificationProcess.php", true);
    request.send(form);

}

function verify() {

    var code = document.getElementById("vcode");

    var form = new FormData();
    form.append("c", code.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "verificationProcess.php", true);
    request.send(form);

}

var mm;

function viewMsgModal(email) {
    var m = document.getElementById("contactAdmin" + email);
    mm = new bootstrap.Modal(m);
    mm.show();
    loadAdminChat(email);
}

function loadAdminChat(email) {

    var e = email;

    var form = new FormData();
    form.append("e", e);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("message_body" + email).innerHTML = response;
        }
    }

    request.open("POST", "loadAdminMsgProcess.php", true);
    request.send(form);
}

function blockUser(email) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            alert(response);
            window.location.reload();
        }
    }

    request.open("GET", "userBlockProcess.php?email=" + email, true);
    request.send();

}

function sendAdminMsg(email) {
    var msg = document.getElementById("msgtxt" + email).value;
    var e = email;

    var form = new FormData();
    form.append("msg", msg);
    form.append("e", e);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            if (request.responseText == "success") {
                document.getElementById("msgtxt" + email).value = "";
                loadAdminChat(email);

            }

        }

    };
    request.open("POST", "sendAdminMsgProcess.php", true);
    request.send(form);

}

var pm;

function viewProductModal(id) {
    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;

function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            alert(response);
            window.location.reload();
        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();

}

var vc;
var e;
var n;

function verifyCategory() {

    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var form = new FormData();
    form.append("email", e);
    form.append("name", n);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Success") {
                cm.hide();
                vc.show();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "addNewCategoryProcess.php", true);
    request.send(form);

}

function saveCategory() {
    var txt = document.getElementById("txt").value;

    var form = new FormData();
    form.append("t", txt);
    form.append("e", e);
    form.append("n", n);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                vc.hide();
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "saveCategoryProcess.php", true);
    request.send(form);
}

function addNew() {
    window.location.reload;
}

function changeProductImage() {
    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (let x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }
        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.")
        }
    }
}

function addProduct() {
    // alert("ok");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("ca", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("q", qty.value);
    form.append("co", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("de", desc.value);

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);

    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                alert("Product Successfully Added!!!")
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "addProductProcess.php", true);
    request.send(form);
}

function changeProfileImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }
}

function showChangePassword() {

    var textfield = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide";
    } else {
        textfield.type = "password";
        button.innerHTML = "Show";
    }

}

function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var password = document.getElementById("np");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimage");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("pw", password.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("p", province.value);
    form.append("d", district.value);
    form.append("c", city.value);
    form.append("pc", pcode.value);
    form.append("i", image.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "Updated" || response == "Saved") {
                window.location.reload();
            } else if (response == "You have not selected any image") {
                // alert("You have not selected any image.");
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);
}

function addToWatchlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "added") {
                document.getElementById("heart" + id).style.className = "text-danger";
                window.location.reload();
            } else if (response === "removed") {
                document.getElementById("heart" + id).style.className = "text-dark";
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    request.send();

}

function removeFromWatchlist(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    request.send();
}

function addToCart(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            alert(response);
        }
    }

    request.open("GET", "addToCartProcess.php?id=" + id, true);
    request.send();

}

function changeQTY(id, allqty) {
    var qty = document.getElementById("qty_num" + id).value;

    if (qty < 1) {
        document.getElementById("qty_num" + id).value = "1";
        alert("Invalid quentity");
    } else if (qty > allqty) {
        document.getElementById("qty_num" + id).value = allqty;
        alert("Not Available Quentity");
    } else {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function () {
            if (request.status == 200 & request.readyState == 4) {
                var response = request.responseText;
                if (response == "Updated") {
                    window.location.reload();
                } else {
                    alert(response);
                }
            }
        }

        request.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
        request.send();
    }

}

function deleteFromCart(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Removed") {
                alert("Product removed from Cart.");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    request.send();

}

function loadMainImg(id) {
    // alert("ok");
    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.innerHTML = "";
    main_img.style.backgroundImage = "url(" + sample_img + ")";

}

function check_value(qty) {

    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity must be 01 or more.");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficient Quantity.");
        input.value = qty;
    }

}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue;
    } else {
        alert("Maximum quantity has achieved.");
        input.value = qty;
    }

}

function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue;
    } else {
        alert("Minimum quantity has achieved.");
        input.value = 1;
    }
}

function payNow(id) {
    // alert("ok");

    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var mail = obj["umail"];
            var amount = obj["amount"];

            if (response == 1) {
                alert("Please Login.");
                window.location = "home.php";
            } else if (response == 2) {
                alert("Please update your profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    alert("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);

                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/bookshop/singleProductView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/bookshop/singleProductView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }

        }
    }

    request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);

}

function printInvoice() {
    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var pub = document.getElementById("b1");
    var author = document.getElementById("m");

    var form = new FormData();
    form.append("t", txt.value);
    form.append("cat", category.value);
    form.append("b", pub.value);
    form.append("m", author.value);
    form.append("page", x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("view_area").innerHTML = response;
        }
    }

    request.open("POST", "advancedSearchProcess.php", true);
    request.send(form);

}

var m;
function addFeedback(id) {
    // alert(id);
    var FeedbackModal = document.getElementById("feedbackmodal" + id);
    m = new bootstrap.Modal(FeedbackModal);
    m.show();

}

function saveFeedback(id) {

    var type;

    if (document.getElementById("type1" + id).checked) {
        type = 1;
    } else if (document.getElementById("type2" + id).checked) {
        type = 2;
    } else if (document.getElementById("type3" + id).checked) {
        type = 3;
    }
    // alert(type);
    var feedback = document.getElementById("feed" + id);

    var form = new FormData();
    form.append("pid", id);
    form.append("t", type);
    form.append("f", feedback.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Feedback saved.");
                m.hide();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveFeedbackProcess.php", true);
    request.send(form);

}

function updateAdminProfile() {
    var email = document.getElementById("email").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;

    if (fname == "") {
        alert("Please enter first name");
    } else if (lname == "") {
        alert("Please enter last name");
    } else {
        var form = new FormData();
        form.append("e", email);
        form.append("f", fname);
        form.append("l", lname);

        var request = new XMLHttpRequest();

        request.onreadystatechange = function () {
            if (request.status == 200 & request.readyState == 4) {
                var response = request.responseText;
                if (response == "success") {
                    alert("Profile Updated Successfully.");
                    window.location.reload();
                } else {
                    alert(response);
                }
            }
        }

        request.open("POST", "adminProfileUpdate.php", true);
        request.send(form);
    }
}

function loadSales() {
    var status = document.getElementById("statusSelect").value;

    var form = new FormData();
    form.append("s", status);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            // alert(request.responseText);
            document.getElementById("salesViewDiv").innerHTML = request.responseText;
        }

    };
    request.open("POST", "adminSalesViewProcess.php", true);
    request.send(form);
}

function orderStatusChange(status, invoice_id) {

    var form = new FormData();
    form.append("s", status);
    form.append("i", invoice_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            alert(request.responseText + " Successfully.");
            window.location.reload();
            // document.getElementById("salesViewDiv").innerHTML = request.responseText;
        }

    };
    request.open("POST", "adminStatusChangeProcess.php", true);
    request.send(form);
}

function sendid(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "Success") {
                window.location = "updateProduct.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "sendIdProcess.php?id=" + id, true);
    request.send();
}

function updateProduct() {

    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var discription = document.getElementById("d");
    var images = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("t", title.value);
    form.append("q", qty.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("d", discription.value);

    var file_count = images.files.length;

    for (let x = 0; x < file_count; x++) {
        form.append("i" + x, images.files[x]);

    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Product has been Updated.") {
                window.location = "manageProducts.php";
            } else if (response == "Product has been Updated.Invalid Image Count.") {
                window.location = "manageProducts.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "updateProductProcess.php", true);
    request.send(form);
}

function searchCatogory() {
    var cat_id = document.getElementById("catogory").value;
    window.location = "categoryView.php?id=" + cat_id;
}

function saveMessage() {
    var msg = document.getElementById("msgtxt").value;

    var form = new FormData();
    form.append("msg", msg);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            if (request.responseText == "success") {
                document.getElementById("msgtxt").value = "";
                loadChat();

            }

        }

    };
    request.open("POST", "saveMesaageProcess.php", true);
    request.send(form);
}

function loadChat() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            document.getElementById("message_body").innerHTML = request.responseText;
        }

    };
    request.open("GET", "loadChatProcess.php", true);
    request.send();
}

function addPublisher(){
    var pub = document.getElementById("newpublisher").value;

    var form = new FormData();
    form.append("pub", pub);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            alert(request.responseText);
            window.location.reload();
        }
    };
    request.open("POST", "addPublisherProcess.php", true);
    request.send(form);
}

function addAuthor(){
    var aut = document.getElementById("newauthor").value;

    var form = new FormData();
    form.append("aut", aut);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            alert(request.responseText);
            window.location.reload();
        }
    };
    request.open("POST", "addAuthorProcess.php", true);
    request.send(form);
}