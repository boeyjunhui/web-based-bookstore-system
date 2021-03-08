<?php

include("../db_connect.php");

$customerid = intval($_GET ['id']);

$query = "DELETE FROM customer WHERE CustomerID='$customerid'";
$query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Customer account is deleted successfully.");
                window.location.href="../../customer_view.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete customer account. Please try again.");
                window.location.href="../../customer_view.php";
            </script>';
        }
        mysqli_close($connection);


?>