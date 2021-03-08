<?php
include("../db_connect.php");

if (isset($_POST['update_order_btn'])) {

$orderid = $_POST['orderid'];
$paymentmethod = $_POST['payment_method'];
$bank = $_POST['bank'];
$bankreferenceno = $_POST['bank_reference_no'];
$courier = $_POST['courier'];
$trackingnumber = $_POST['tracking_number'];
$status = $_POST['status'];
$message = addslashes($_POST['message']);


$update_textbox_query = "UPDATE new_order SET PaymentMethod='$paymentmethod', BankType='$bank', ReferenceNumber='$bankreferenceno', 
CourierType='$courier',TrackingNumber='$trackingnumber', Status='$status', Message='$message' WHERE OrderID='$orderid'";
$update_textbox_query_run = mysqli_query($connection, $update_textbox_query);

if ($update_textbox_query_run) {
    echo
    '<script>
        alert("Order is edited successfully.");
        window.history.back();
    </script>';
} else {
    echo
    '<script>
        alert("Failed to edit the order. Please try again.");
        return false;
    </script>';
}

mysqli_close($connection); 
}

if (isset($_POST['update_stock_quantity_btn'])){

    $orderid = $_POST['orderid'];
    $select_order_item_query = "SELECT * FROM order_item
    INNER JOIN book ON order_item.bookID = book.BookID
    INNER JOIN new_order ON order_item.OrderID = new_order.OrderID
    WHERE order_item.OrderID='$orderid'
    ORDER BY book.StockQuantity ASC";
    
    $select_order_item_query_run = mysqli_query($connection, $select_order_item_query);
    while ($row = mysqli_fetch_array($select_order_item_query_run)) {
        $quantity = $row['Quantity'];
        $bookid = $row['BookID'];
        $stockQuantity = $row['StockQuantity'];
       
        
        if ($stockQuantity >= $quantity) {
        $update_quantity_query = "UPDATE book SET StockQuantity = StockQuantity - '$quantity' WHERE BookID = $bookid";
        $update_quantity_query_run = mysqli_query($connection, $update_quantity_query);
        $update_quantity_status_query = "UPDATE new_order SET QuantityReducedStatus = 'True' WHERE OrderID='$orderid'";
        $update_quantity_status_query_run = mysqli_query($connection, $update_quantity_status_query);
        echo
        '<script>
            alert("Stock quantity of each book is reduced successfully.");
            window.history.back();
        </script>';

        }
        else {
        
        echo
        '<script>
            alert("No more stock available. Please check stock quantity for each book.");
            window.history.back();
        </script>';
            
        break;
        }          
    }   
mysqli_close($connection);  
}    

 
?>

