<?php

include("../db_connect.php");

$supplierid = intval($_GET ['id']);

$query = "DELETE FROM supplier WHERE SupplierID='$supplierid'";
$query_run = mysqli_query($connection, $query);

if ($query_run) {
    echo
    '<script>
        alert("Supplier profile is deleted successfully.");
        window.location.href="../../supplier_view.php";
    </script>';
} else {
    echo
    '<script>
        alert("Failed to delete supplier profile. Please try again.");
        window.location.href="../../supplier_view.php";
    </script>';
}
mysqli_close($connection);


?>