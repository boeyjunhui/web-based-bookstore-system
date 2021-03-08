<?php

include("../db_connect.php");

$bookid = intval($_GET ['id']);

$query = "DELETE FROM book WHERE BookID='$bookid'";
$query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("The book is deleted successfully.");
                window.location.href="../../book_view.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete the book. Please try again.");
                window.location.href="../../book_view.php";
            </script>';
        }
        mysqli_close($connection);


?>

