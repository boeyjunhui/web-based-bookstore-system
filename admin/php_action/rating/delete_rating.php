<?php

include("../db_connect.php");

$id = intval($_GET ['id']);

$query = "DELETE FROM rating WHERE RateID='$id'";
$query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Rating record is deleted successfully.");
                window.location.href="../../rating_view.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete rating record. Try again.");
                window.location.href="../../rating_view.php";
            </script>';
        }
        mysqli_close($connection);


?>