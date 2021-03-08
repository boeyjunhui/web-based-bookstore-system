<!DOCTYPE html>

<html lang="en">

<head>
    <title>Orders</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

    // Validation for enter URL without login
    if (!$_SESSION['CustomerId']) {
        header('location: customer_login.php');
    }
    ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="text-center mt-5 mb-3"><b>My Orders</b></h1>

            <!-- My Orders Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment Method</th>
                        <th>Reference Number</th>
                        <th>Bank Type</th>
                        <th>Grand Total</th>
                        <th>Courier Type</th>
                        <th>Tracking Number</th>
                        <th>Status</th>
                        <th>Receipt</th>
                        <th>Order Info</th>
                        <th>Cancel Order</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "book_republic");

                    $query = "SELECT * FROM new_order
                    WHERE CustomerID='$_SESSION[CustomerId]' AND Status='Awaiting Payment'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Awaiting Fulfillment'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Awaiting Shipment'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Awaiting Pickup'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Shipped'
                    ORDER BY new_order.OrderID DESC";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>

                            <tr>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['Time']; ?></td>
                                <td><?php echo $row['PaymentMethod']; ?></td>
                                <td><?php echo $row['ReferenceNumber']; ?></td>
                                <td><?php echo $row['BankType']; ?></td>
                                <td><?php echo "RM " . number_format($row['GrandTotal'], 2); ?></td>
                                <td><?php echo $row['CourierType']; ?></td>
                                <td><?php echo $row['TrackingNumber']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                                <td>
                                    <?php
                                    if (($row['Status'] !== "Awaiting Payment") && ($row['Status'] !== "Awaiting Fulfillment") && ($row['Status'] !== "Cancelled") && ($row['Status'] !== "Declined") && ($row['Status'] !== "Refunded")) {
                                        echo '<form action="customer_order_receipt.php" method="POST">';
                                        echo '<input type="hidden" name="order_id" value="' . $row['OrderID'] . '">';
                                        echo '<button class="btn btn-primary" type="submit" name="order_receipt_btn">Receipt</button>';
                                        echo '</form>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <form action="order_item.php" method="POST">
                                        <input type="hidden" name="order_id" value="<?php echo $row['OrderID']; ?>">
                                        <button class="btn btn-info" type="submit" name="order_item_btn">Order Item</button>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    if (($row['Status'] == "Awaiting Payment") || ($row['Status'] == "Awaiting Fulfillment")) {
                                        echo '<form action="process.php" method="POST">';
                                        echo '<input type="hidden" name="order_id" value="' . $row['OrderID'] . '">';
                                        echo '<button class="btn btn-danger" onClick="return confirm(\'Are you sure to cancel your order?\');" type="submit" name="cancel_order_btn">Cancel Order</button>';
                                        echo '</form>';
                                    }
                                    ?>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "No order is found.";
                    }
                    mysqli_close($connection);
                    ?>

                </tbody>
            </table>

            <br>

            <!-- Title -->
            <h1 class="text-center mt-5 mb-3"><b>Order History</b></h1>

            <!-- Order History Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment Method</th>
                        <th>Reference Number</th>
                        <th>Bank Type</th>
                        <th>Grand Total</th>
                        <th>Courier Type</th>
                        <th>Tracking Number</th>
                        <th>Status</th>
                        <th>Receipt</th>
                        <th>Order Info</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "book_republic");

                    $query = "SELECT * FROM new_order
                    WHERE CustomerID='$_SESSION[CustomerId]' AND Status='Completed'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Cancelled'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Declined'
                    OR CustomerID='$_SESSION[CustomerId]' AND Status='Refunded'
                    ORDER BY new_order.OrderID DESC";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>

                            <tr>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['Time']; ?></td>
                                <td><?php echo $row['PaymentMethod']; ?></td>
                                <td><?php echo $row['ReferenceNumber']; ?></td>
                                <td><?php echo $row['BankType']; ?></td>
                                <td><?php echo "RM " . number_format($row['GrandTotal'], 2); ?></td>
                                <td><?php echo $row['CourierType']; ?></td>
                                <td><?php echo $row['TrackingNumber']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                                <td>
                                    <?php
                                    if (($row['Status'] !== "Awaiting Payment") && ($row['Status'] !== "Awaiting Fulfillment") && ($row['Status'] !== "Cancelled") && ($row['Status'] !== "Declined") && ($row['Status'] !== "Refunded")) {
                                        echo '<form action="customer_order_receipt.php" method="POST">';
                                        echo '<input type="hidden" name="order_id" value="' . $row['OrderID'] . '">';
                                        echo '<button class="btn btn-primary" type="submit" name="order_receipt_btn">Receipt</button>';
                                        echo '</form>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <form action="order_item.php" method="POST">
                                        <input type="hidden" name="order_id" value="<?php echo $row['OrderID']; ?>">
                                        <button class="btn btn-info" type="submit" name="order_item_btn">Order Item</button>
                                    </form>
                                </td>
                            </tr>

                    <?php
                        }
                    } else {
                        echo "No order history is found.";
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