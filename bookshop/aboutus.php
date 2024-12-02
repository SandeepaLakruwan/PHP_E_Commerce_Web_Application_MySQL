<?php

include "Database.php";
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>About Us | Unicorn</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="logo.jpg" />

</head>

<body style="background-color: #c5e1fa;background-image: linear-gradient(90deg,#c5e1fa 0%,#376894 100%);">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <div class="col-12" id="basicSearchResult">
                <div class="row justify-content-center">

                    <div class="col-12 mt-3 text-center">
                        <h1>About Us</h1>
                    </div>

                    <div class="col-5 mt-3 text-center mb-4">
                        <img src="resource/join.jpg" style="height: 400px;" />
                    </div>

                    <div class="col-5 mt-3 text-center mb-4 m-3 shadow bg-dark bg-opacity-25">
                        <div class="row">
                            <div class="col-12 mx-auto mt-3">
                                <h5 class="text-uppercase text-light mb-4">Unicorn</h5>
                                <p>Here we are the unicorn.lk&trade; to support you for finding your favourite books easily through
                                    online.</p>

                                <h5 class="text-uppercase text-white mb-4">Contact</h5>

                                <p><i class="bi bi-house-fill"></i> Maradana, Colombo 10, Sri Lanka</p>
                                <p><i class="bi bi-at"></i> unicornbooks@gmail.com</p>
                                <p><i class="bi bi-telephone-fill"></i> +94 112 356 356</p>
                                <p><i class="bi bi-printer-fill"></i> +94 112 356 356</p>

                                <p class="text-white mt-2 mb-1 fs-5">Follow Us</p>
                                <div class="text-center">

                                    <ul class="list-unstyled list-inline">

                                        <li class="list-inline-item">
                                            <a href="#" class="form-floating text-dark">
                                                <i class="bi bi-facebook" style="font-size: 22px;"></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="#" class="form-floating text-dark">
                                                <i class="bi bi-twitter" style="font-size: 22px;"></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="#" class="form-floating text-dark">
                                                <i class="bi bi-whatsapp" style="font-size: 22px;"></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="#" class="form-floating text-dark">
                                                <i class="bi bi-linkedin" style="font-size: 22px;"></i>
                                            </a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="#" class="form-floating text-dark">
                                                <i class="bi bi-youtube" style="font-size: 22px;"></i>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-10 mt-3 text-center">
                        <p class="fs-5">Welcome to Unicorn Book Shop, a haven for book lovers and seekers of literary treasures.
                            Founded in 2010, our independent bookstore is nestled in the heart of downtown, serving as a vibrant
                            community hub for readers of all ages. We are passionate about creating a space where imagination thrives,
                            offering a curated selection of books that inspire, educate, and entertain. At Unicorn Book Shop, every
                            visitor is greeted with a warm smile and personalized recommendations, making each visit a memorable experience. </p>
                    </div>

                    <div class="col-10 mt-3 text-center">
                        <p class="fs-5">Our shelves are filled with a diverse collection of titles spanning various genres, including
                            fiction, non-fiction, children’s literature, young adult novels, and rare collectibles. We pride ourselves
                            on sourcing unique and hard-to-find books, ensuring that our inventory reflects the eclectic tastes of our
                            customers. Whether you’re searching for the latest bestseller, a timeless classic, or an undiscovered gem,
                            Unicorn Book Shop is your destination for literary discovery and adventure.</p>
                    </div>

                    <div class="col-5 mt-3 text-center">
                        <img src="resource/join.jpeg" style="height: 200px;"/>
                    </div>

                    <div class="col-5 mt-3 text-center">
                        <p class="fs-5">Beyond books, we are committed to fostering a love of reading and learning within our community.
                            We host a range of events, from author signings and book launches to reading clubs and storytelling sessions
                            for children. Our partnerships with local schools and libraries further our mission to promote literacy and
                            lifelong learning. At Unicorn Book Shop, we believe in the transformative power of books and strive to make
                            reading accessible and enjoyable for everyone.</p>
                    </div>

                    <div class="col-10 mt-3 text-center">
                        <p class="fs-5">Our dedicated team of bibliophiles is at the heart of Unicorn Book Shop. With a deep knowledge
                            of literature and a genuine enthusiasm for books, they are here to assist you in finding the perfect read.
                            We take pride in our exceptional customer service, ensuring that each visit to our store is a delightful
                            and enriching experience. Join us at Unicorn Book Shop, where the magic of reading comes to life, and let
                            us embark on a literary journey together.</p>
                    </div>

                    

                </div>
            </div>
            <div class="message-icon" data-bs-toggle="modal" data-bs-target="#contactAdmin" onclick="loadChat();">
                <img src="resource/comments.png" style="height:50px;" />
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