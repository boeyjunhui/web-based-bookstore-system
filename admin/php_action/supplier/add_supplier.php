<?php

include("../db_connect.php");

if (isset($_POST['add_supplier_btn'])) {

    $description = addslashes($_POST['description']);

    $query = "INSERT INTO supplier (SupplierName, CompanyName, Email, CompanyAddress, ContactNumber, Description) 
    VALUES ('$_POST[supplier_name]','$_POST[company_name]','$_POST[email]','$_POST[company_address]','$_POST[contact_number]',
    '$description')";
    
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        echo 
        '<script>
            alert("Supplier added successfully.");
            window.location.href="../../supplier_view.php";
        </script>';
      } else {
        echo 
        '<script>
            alert("Failed add supplier. Please Try again.");
            return false;
        </script>';
        
    }
    mysqli_close($connection);
}
?>