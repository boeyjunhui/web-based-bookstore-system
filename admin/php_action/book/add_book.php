<?php

include("../db_connect.php");

if (isset($_POST['add_book_btn'])) {

    $title = addslashes($_POST['book_title']);
    $description = addslashes($_POST['book_description']);
    $image = $_FILES['book_image']['tmp_name'];
    $img= file_get_contents($image);

    $query = "INSERT INTO book (Title, Author, Description, Rating, ISBN13, Format, Dimensions, Weight, Publisher, 
    PublicationDate, Image, Category, StockQuantity, SalePrice) 
    VALUES ('$title','$_POST[author]','$description','$_POST[rating]','$_POST[isbn13]','$_POST[format]',
    '$_POST[dimension]','$_POST[weight]','$_POST[publisher]','$_POST[publication_date]',?,'$_POST[book_category]','$_POST[quantity]',
    '$_POST[sale_price]')";
    
    $stmt= mysqli_prepare($connection,$query);
    mysqli_stmt_bind_param($stmt,"s",$img);
    mysqli_stmt_execute($stmt);
    $query_run = mysqli_stmt_affected_rows($stmt);
    if ($query_run == 1) {
        echo 
        '<script>
            alert("New Book added successfully.");
            window.location.href="../../book_view.php";
        </script>';
      } else {
        echo 
        '<script>
            alert("Failed to add new book. Please Try again.");
            return false;
        </script>';
        
    }
    mysqli_close($connection);
}
?>
