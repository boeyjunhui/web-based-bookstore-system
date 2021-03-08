<!DOCTYPE html>

<html lang="en">

<head>
    <title>Order Item</title>
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
            <!-- Back Button -->
            <a class="btn btn-default mt-3" href="orders.php"><i class="fa fa-chevron-left"></i> Back</a>

            <!-- Title -->
            <h1 class="text-center mt-3 mb-3"><b>Order Item</b></h1>

            <!-- Order Item Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Book Image</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "book_republic");

                    $neworderid = $_POST['order_id'];

                    $query = "SELECT * FROM order_item
                    INNER JOIN book ON order_item.BookID = book.BookID
                    INNER JOIN new_order ON order_item.OrderID = new_order.OrderID
                    WHERE order_item.OrderID = '$neworderid'";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>

                            <tr>
                                <td><?php echo $row['Title']; ?></td>
                                <td>
                                    <?php echo '<img src=data:image;base64,' . base64_encode($row['Image']) . ' width="100px" height="150px" alt="Book Image">'; ?>
                                </td>
                                <td><?php echo $row['Quantity']; ?></td>
                                <td><?php echo "RM " . number_format($row['Quantity'] * $row['SalePrice'], 2); ?></td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "No order item is found.";
                    }
                    mysqli_close($connection);
                    ?>

                </tbody>
            </table>

            <!-- Address, Grand Total & Order Message -->
            <table class="table table-bordered table-hover">
                <tbody>

                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "book_republic");

                    $neworderid = $_POST['order_id'];

                    $query = "SELECT * FROM order_item
                    INNER JOIN book ON order_item.BookID = book.BookID
                    INNER JOIN new_order ON order_item.OrderID = new_order.OrderID
                    WHERE order_item.OrderID = '$neworderid'
                    LIMIT 1";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>

                            <tr>
                                <td colspan="3">Delivery Address: <?php echo $row['DeliveryAddress']; ?></td>
                                <td><b>Grand Total: <?php echo "RM " . number_format($row['GrandTotal'], 2); ?></b></td>
                            </tr>

                            <tr>
                                <td colspan="4">Order Message: <?php echo $row['Message']; ?></td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "Information is not found.";
                    }
                    mysqli_close($connection);
                    ?>

                </tbody>
            </table>

        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>