<?php
include("../db_connect.php");

if (isset($_POST['edit_book_btn'])) {

$bookid =($_POST['bookid']);
$title = addslashes($_POST['book_title']);
$author = $_POST['author'];
$description = addslashes($_POST['book_description']);
$rating = $_POST['rating'];
$isbn13 = $_POST['isbn13'];
$format = $_POST['format'];
$dimension = $_POST['dimensions'];
$weight = $_POST['weight'];
$publisher = $_POST['publisher'];
$publicationdate = $_POST['publication_date'];
$category = $_POST['book_category'];
$stockquantity = $_POST['quantity'];
$saleprice = $_POST['sale_price'];
$image = $_FILES['book_image']['tmp_name'];
$img = NULL;
if (!empty($image)) {
  $img = file_get_contents($image);
}

$update_textbox_query = "UPDATE book SET Title='$title', Author='$author', 
Description='$description', Rating='$rating',  ISBN13='$isbn13' , Format='$format', 
Dimensions='$dimension', Weight='$weight', Publisher='$publisher', PublicationDate='$publicationdate', 
Category='$category', StockQuantity='$stockquantity', SalePrice='$saleprice' WHERE BookID='$bookid'";
$update_textbox_query_run = mysqli_query ($connection, $update_textbox_query);

$update_image_query = "UPDATE book SET Image=? WHERE BookID='$bookid'";

if ($update_textbox_query_run) {
    echo
    '<script>
        alert("Book is edited successfully.");
        window.history.back();
    </script>';
}
else {
    echo
    '<script>
        alert("Failed to edit the book. Please try again.");
        return false;
    </script>';
} 

if (!is_null($img)){
    $stmt= mysqli_prepare($connection,$update_image_query);
    mysqli_stmt_bind_param($stmt,"s",$img);
    mysqli_stmt_execute($stmt);
    $update_image_query_run = mysqli_stmt_affected_rows($stmt);
}
else {
    echo
    '<script>
        alert("Failed to edit the book. Try again.");
        return false;
    </script>';
}
mysqli_close($connection);
}
?>
