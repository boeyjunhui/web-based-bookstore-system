<!DOCTYPE html>

<html lang="en">

<head>
    <title>Thank You</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: homepage.php');
    }
    ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-5"><b>Thank you for your order &#9989</b></h1>
            <br>
            <h4>Your order has completed successfully. We have received your order.</h4>
            <br>
            <h4>Your order won’t be processed until we have received the fund.</h4>
            <br><br>
            <h4>Book Republic Account Name: <b>BOOK REPUBLIC SDN BHD</b></h4>
            <h4>Book Republic Account Number: <b>2525 8383 5656 9191</b></h4>
            <a href="orders.php" class="btn btn-primary mt-5 mb-5" name="view_my_orders_btn">View My Orders</a>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>