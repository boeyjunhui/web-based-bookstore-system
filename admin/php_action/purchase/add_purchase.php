<?php

include("../db_connect.php");

if (isset($_POST['add_purchase_btn'])) {

$bookid = $_POST['book_title'];
$supplierid = $_POST['supplier'];
$quantity = $_POST['quantity'];
$stockprice = $_POST['stock_price'];
$grandtotal = $_POST['grand_total'];
$purchasenumber = mt_rand(00000,99999);
   


$insert_query = "INSERT INTO stock_purchase (BookID, SupplierID, Quantity, StockPrice, GrandTotal, DateAdded, Time, PurchaseNumber) 
VALUES ('$bookid','$supplierid','$quantity','$stockprice','$grandtotal', CURRENT_TIME(), CURRENT_TIME(), '$purchasenumber')";
$insert_query_run = mysqli_query($connection, $insert_query);

$update_query = "UPDATE book SET StockQuantity = StockQuantity + '$quantity' WHERE BookID=$bookid";
$update_query_run = mysqli_query($connection, $update_query);

if ($insert_query_run && $update_query_run) {
    echo 
    '<script>
        alert("Added purchase successfully.");
        window.location.href="../../purchase_view.php";
    </script>';
    } else {
    echo 
    '<script>
        alert("Failed to add purchase. Please try again.");
        return false;
    </script>';
}
mysqli_close($connection);
}
?>