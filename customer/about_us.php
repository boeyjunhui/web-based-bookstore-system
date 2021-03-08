<!DOCTYPE html>

<html lang="en">

<head>
    <title>About Us</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="mt-5 mb-5 text-center"><b>About Us</b></h1>

            <!-- First Column -->
            <div class="col-md-3 col-sm-3">
                <div class="rounded-box text-center">
                    <p>Navigate to...</p>
                    <p class="mt-3 mb-3"><a href="#book_republic">Book Republic</a></p>
                    <p class="mt-3"><a href="#customer_support">Customer Support</a></p>
                </div>
            </div>

            <!-- Empty Space -->
            <div class="col-md-1 col-sm-1"></div>

            <!-- Second Column -->
            <div class="col-md-8 col-sm-8">
                <!-- Book Republic -->
                <div class="rounded-box" id="book_republic">
                    <h2 class="mb-3">Book Republic</h2>
                    <img src="image/book_republic_logo.png" width="300px">
                    <p class="text-justify">
                        Book Republic is a retail bookstore that is established in 2018 in Kuala Lumpur, Malaysia.
                        From the beginning, Book Republic as the small bookstore was selling only a few types of books.
                        Book Republic has since progressed and grown over the years plus with the current situation around
                        the world, the bookstore has taken another step forward to expand the book retail business by
                        entering into the e-commerce world and introduce our first online bookstore.
                    </p>
                    <br>
                    <p>
                        We aim to expand our business into more places in the near future and provide even more selections
                        for our customers.
                    </p>
                </div>

                <br><br><br><br>

                <!-- Customer Support -->
                <div class="rounded-box" id="customer_support">
                    <h2 class="mb-3">Customer Support</h2>
                    <p class="text-justify">
                        Your feedbacks are important for us to improve and provide you a better service.
                        Do reach us out and let us know how can we help you. You may contact us through:
                    </p>
                    <br>
                    <p>Call Support: <a href="tel: +60333552520">+603 3355 2520</a></p>
                    <br>
                    <p>Email Support: <a href="mailto: bookrepublic6@gmail.com">bookrepublic6@gmail.com</a></p>
                </div>

                <br><br>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>