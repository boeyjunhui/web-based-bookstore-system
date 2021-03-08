<!DOCTYPE html>

<html lang="en">

<head>
    <title>Shopping Cart</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

    $connection = mysqli_connect("localhost", "root", "", "book_republic");

    // Validation for enter URL without login
    if (!$_SESSION['CustomerId']) {
        header('location: customer_login.php');
    }

    // Update quantity in shopping cart
    if (isset($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as $id => $quantity) {

            $query = "SELECT * FROM book WHERE BookID='$id'";
            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {

                    if (isset($_POST['update_quantity_btn'])) {

                        $id = $_POST['book_id'];
                        $quantity = $_POST['quantity'];

                        if (($quantity > 0 && $quantity > $row['StockQuantity']) && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                            echo
                            '<script>
                                alert("Failed to update quantity! You have entered a number that exceed the stock.");
                            </script>';
                        } else if ($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                            $_SESSION['shopping_cart'][$id] = $quantity;
                        }
                    }
                }
            }
        }
    }

    // Delete all cart items
    if (isset($_POST['remove_all_btn'])) {
        $_SESSION['shopping_cart'] = array();
    }

    // Delete 1 cart item
    if (isset($_POST['remove_btn'])) {
        $id = $_POST['book_id'];
        unset($_SESSION['shopping_cart'][$id]);
    }
    ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="text-center mt-5 mb-5"><b>My Shopping Cart</b></h1>

            <!-- Shopping Cart Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Book Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <?php
                        if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] !== array()) {
                            echo '<th>';
                            echo '<form action="shopping_cart.php" method="POST">';
                            echo '<button class="btn btn-danger" onClick="return confirm(\'Confirm remove all books from the shopping cart?\');" type="submit" name="remove_all_btn">Remove All</button>';
                            echo '</form>';
                            echo '</th>';
                        }
                        ?>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $grandtotal = 0;

                    if (isset($_SESSION['shopping_cart'])) {
                        foreach ($_SESSION['shopping_cart'] as $id => $quantity) {

                            $query = "SELECT * FROM book WHERE BookID='$id'";
                            $query_run = mysqli_query($connection, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {

                                    $subtotal = $quantity * $row['SalePrice'];
                                    $grandtotal += $subtotal;
                                    $_SESSION['grand_total'] = $grandtotal;
                    ?>

                                    <tr>
                                        <td><?php echo $row['Title']; ?></td>
                                        <td><?php echo '<img src=data:image;base64,' . base64_encode($row['Image']) . ' width="150px" height="200px" alt="Book Image">'; ?></td>
                                        <td><?php echo "RM " . number_format($row['SalePrice'], 2); ?></td>
                                        <td>
                                            <form action="shopping_cart.php" method="POST">
                                                <input class="rounded-input-box" type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" max="10">
                                                <input type="hidden" name="book_id" value="<?php echo $id; ?>">
                                                <input class="btn btn-primary" type="submit" name="update_quantity_btn" value="Update">
                                            </form>
                                        </td>
                                        <td><?php echo "RM " . number_format($subtotal, 2); ?></td>
                                        <td>
                                            <form action="shopping_cart.php" method="POST">
                                                <input type="hidden" name="book_id" value="<?php echo $id; ?>">
                                                <button class="btn btn-danger" onClick="return confirm('Confirm remove this book from the shopping cart?');" type="submit" name="remove_btn">Remove</button>
                                            </form>
                                        </td>
                                    </tr>

                    <?php
                                }
                            }
                        }
                        mysqli_close($connection);
                    }
                    ?>

                    <tr>
                        <td colspan="2">
                            <a href="homepage.php" class="btn btn-primary" name="continue_shopping_btn">Continue Shopping</a>
                        </td>
                        <td colspan="3">
                            <p><b>
                                    <?php
                                    if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] !== array()) {
                                        echo "Grand Total: RM " . number_format($grandtotal, 2);
                                    } else {
                                        echo "Your shopping cart is empty.";
                                    }
                                    ?>
                                </b></p>
                        </td>
                        <?php
                        if (isset($_SESSION['shopping_cart']) && $_SESSION['shopping_cart'] !== array()) {
                            echo '<td>';
                            echo '<a href="payment.php" class="btn btn-success" name="proceed_to_payment_btn">Proceed to Payment</a>';
                            echo '</td>';
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>