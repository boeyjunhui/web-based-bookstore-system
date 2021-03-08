<?php

include("../db_connect.php");

$contactid = intval($_GET ['id']);

$query = "DELETE FROM contact WHERE ContactID='$contactid'";
$query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Message is deleted successfully.");
                window.location.href="../../contact_view.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete message. Please try again.");
                window.location.href="../../contact_view.php";
            </script>';
        }
        mysqli_close($connection);


?>