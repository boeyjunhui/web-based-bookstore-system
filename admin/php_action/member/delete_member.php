<?php

include("../db_connect.php");

$memberid = intval($_GET ['id']);

$query = "DELETE FROM organization_member WHERE MemberID='$memberid'";
$query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Member account is deleted successfully.");
                window.location.href="../../member_view.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to delete member account. Please try again.");
                window.location.href="../../member_view.php";
            </script>';
        }
        mysqli_close($connection);


?>