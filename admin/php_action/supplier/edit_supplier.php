<?php
include("../db_connect.php");

if (isset($_POST['update_supplier_btn'])) {

$supplierid = $_POST['supplierid'];
$suppliername = $_POST['supplier_name'];
$companyname = $_POST['company_name'];
$email = $_POST['email'];
$companyaddress = $_POST['company_address'];
$contactnumber = $_POST['contact_number'];
$description = addslashes($_POST['description']);

$query = "UPDATE supplier SET SupplierName='$suppliername', CompanyName='$companyname', Email='$email', CompanyAddress='$companyaddress',
ContactNumber='$contactnumber' , Description='$description' WHERE SupplierID='$supplierid'";

$query_run = mysqli_query($connection, $query);
if ($query_run) {
    echo
    '<script>
        alert("Profile is edited successfully.");
        window.location.href="../../supplier_view.php";
    </script>';
} else {
    echo
    '<script>
        alert("Failed to edit the profile. Try again.");
        return false;
    </script>';
}
mysqli_close($connection);
}
?>
