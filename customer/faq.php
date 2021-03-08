<!DOCTYPE html>

<html lang="en">

<head>
    <title>Frequently Asked Questions</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="mt-5 mb-5 text-center">Frequently Asked Questions &#129300</h1>

            <!-- First Column -->
            <div class="col-md-3 col-sm-3">
                <div class="rounded-box text-center">
                    <p>Navigate to...</p>
                    <p class="mt-3 mb-3"><a href="#business">Business</a></p>
                    <p class="mt-3 mb-3"><a href="#payment">Payment</a></p>
                    <p class="mt-3 mb-3"><a href="#order">Order</a></p>
                    <p class="mt-3"><a href="#delivery">Delivery</a></p>
                </div>
            </div>

            <!-- Empty Space -->
            <div class="col-md-1 col-sm-1"></div>

            <!-- Second Column -->
            <div class="col-md-8 col-sm-8">
                <!-- Business -->
                <div class="rounded-box" id="business">
                    <h2>Business</h2>

                    <h3 class="mt-3 faq-question">&#10067 What is your business hour?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Our business hour is 8:00 am to 8:00 pm everyday.</h3>
                </div>

                <br><br><br><br>

                <!-- Payment -->
                <div class="rounded-box" id="payment">
                    <h2>Payment</h2>

                    <h3 class="mt-3 faq-question">&#10067 Which payment method does your bookstore accepts?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Direct bank transfer is the only payment method we accepted.</h3>
                    <br>
                    <h3 class="mt-3 faq-question">&#10067 Which bank does your bookstore accepts?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 We accept local banks only. Here's the list of the accepted banks: -</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Alliance Bank, AmBank, CIMB Bank, Hong Leong Bank, MayBank, Public Bank & RHB Bank</h3>
                    <br>
                    <h3 class="mt-3 faq-question">&#10067 What is the Book Republic bank account name & account number?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Account Name: BOOK REPUBLIC SDN BHD</h3>
                    <h3 class="ml-3 mb-3 faq-answer">&#9989 Account Number: 2525 8383 5656 9191</h3>
                </div>

                <br><br><br><br>

                <!-- Order -->
                <div class="rounded-box" id="order">
                    <h2>Order</h2>

                    <h3 class="mt-3 faq-question">&#10067 When will my order be processed?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Your order will be processed after the fund is cleared.</h3>
                    <br>
                    <h3 class="mt-3 faq-question">&#10067 What happens when the book I ordered is out of stock?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Your order will be cancelled and we will make a refund to you.</h3>
                    <br>
                    <h3 class="mt-3 faq-question">&#10067 What does my order status mean?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Awaiting Payment: Customer has placed the order, but payment has yet to be confirmed.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Awaiting Fulfillment: Customer has completed the payment, but order has yet to be confirmed.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Awaiting Shipment: Order has been confirmed and packaged. The package is sent to the courier service center awaiting for shipment.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Awaiting Pickup: Order has been shipped to a specific courier service location and awaiting rider to pickup or pick up manually by the customer.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Completed: Order has been shipped or picked up, and receipt is confirmed.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Shipped: Order has been shipped, but receipt has not been confirmed.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Cancelled: Bookstore has cancelled the order, due to a stock inconsistency or other reasons.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Declined: Bookstore has marked the order as declined due to a specific reason.</h3>
                    <h3 class="mb-3 ml-3 faq-answer">&#9989 Refunded: Order is cancelled or declined, and payment is refunded to the customer.</h3>
                </div>

                <br><br><br><br>

                <!-- Delivery -->
                <div class="rounded-box" id="delivery">
                    <h2>Delivery</h2>

                    <h3 class="mt-3 faq-question">&#10067 Who is going to deliver my order?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 We will send your order to one of the courier services after finished preparing. The courier service will be responsible in delivering the order to you.</h3>
                    <br>
                    <h3 class="mt-3 faq-question">&#10067 When will my order arrive?</h3>
                    <h3 class="mt-3 mb-3 ml-3 faq-answer">&#9989 Delivery times may vary for different types of courier services. Typically it takes 4-7 business days to arrive depending on your delivery address.</h3>
                </div>

                <br><br>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>