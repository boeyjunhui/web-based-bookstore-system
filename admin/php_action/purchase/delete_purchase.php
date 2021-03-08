<?php

include("../db_connect.php");

$purchaseid = intval($_GET ['id']);
$select_query = "SELECT * FROM stock_purchase WHERE PurchaseID='$purchaseid'";
$select_query_run = mysqli_query($connection, $select_query);
while ($row = mysqli_fetch_assoc($select_query_run)) {
$quantity = $row['Quantity'];
$bookid = $row['BookID'];
}

$update_query = "UPDATE book SET StockQuantity = StockQuantity - '$quantity' WHERE BookID=$bookid";
$delete_query = "DELETE FROM stock_purchase WHERE PurchaseID='$purchaseid'";

$update_query_run = mysqli_query($connection, $update_query);
$delete_query_run = mysqli_query($connection, $delete_query);

if ($update_query_run && $delete_query_run) {
    echo
    '<script>
        alert("The purchase record is deleted successfully.");
        window.location.href="../../purchase_view.php";
    </script>';
} else {
    echo
    '<script>
        alert("Failed to delete the purchase record. Please try again.");
        window.location.href="../../purchase_view.php";
    </script>';
}
mysqli_close($connection);

?>