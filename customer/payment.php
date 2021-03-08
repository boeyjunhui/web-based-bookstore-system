<!DOCTYPE html>

<html lang="en">

<head>
    <title>Payment</title>
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
            <!-- Back to Cart Button -->
            <div class="container">
                <a class="btn btn-default mt-3" href="shopping_cart.php"><i class="fa fa-chevron-left"></i> Back to Cart</a>
            </div>

            <!-- Title -->
            <h1 class="text-center mt-3 mb-3"><b>Payment and Billing</b></h1>

            <form action="process.php" method="POST">
                <!-- First Column -->
                <div class="col-md-4 col-sm-4">
                    <!-- Delivery Address -->
                    <div class="form-group mt-5 mb-5">
                        <label for="delivery_address">Delivery Address *</label>
                        <textarea class="form-control" name="delivery_address" rows="4" cols="10" placeholder="Delivery Address" autocomplete="off" required></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-group mt-5 mb-5">
                        <label for="payment_method">Payment Method *</label>
                        <div>
                            <input type="radio" name="payment_method" value="Direct Bank Transfer" autocomplete="off" required> Direct Bank Transfer
                        </div>
                    </div>
                </div>

                <!-- Empty Column -->
                <div class="col-md-4 col-sm-4"></div>

                <?php
                $connection = mysqli_connect("localhost", "root", "", "book_republic");

                $grandtotal = 0;

                foreach ($_SESSION['shopping_cart'] as $id => $quantity) {

                    $query = "SELECT * FROM book WHERE BookID='$id'";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {

                            $subtotal = $quantity * $row['SalePrice'];
                            $grandtotal += $subtotal;
                        }
                    }
                }
                mysqli_close($connection);
                ?>

                <!-- Second Column -->
                <div class="col-md-4 col-sm-4">
                    <!-- Grand Total & Place Order -->
                    <div class="rounded-box text-center mt-5 mb-5">
                        <h3 class="mb-3"><b>Grand Total: RM <?php echo number_format($grandtotal, 2); ?></b></h3>
                        <button class="btn btn-primary mt-3" type="submit" name="place_order_btn">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>