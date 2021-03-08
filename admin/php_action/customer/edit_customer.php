<?php
include("../db_connect.php");

if (isset($_POST['update_customer_btn'])) {

$customerid = $_POST['customerid'];
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$email = $_POST['email'];
$contactnumber = $_POST['contact_number'];
$streetaddress = $_POST['street_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$password = $_POST['confirm_new_password'];
$accountstatus = $_POST['account_status'];

$update_textbox_query = "UPDATE customer SET FirstName='$firstname', LastName='$lastname', Email='$email', ContactNumber='$contactnumber', 
StreetAddress='$streetaddress', City='$city', State='$state', ZipCode='$zipcode', AccountStatus='$accountstatus' 
WHERE CustomerID='$customerid'";
$update_textbox_query_run = mysqli_query($connection, $update_textbox_query);

$update_password_query = "UPDATE customer SET Password ='$password' WHERE CustomerID='$customerid'";

if ($update_textbox_query_run) {
    echo
    '<script>
        alert("Profile is edited successfully.");
        window.history.back();
    </script>';
} else {
    echo
    '<script>
        alert("Failed to edit the profile. Please try again.");
        return false;
    </script>';
}
if (!empty($password)){

    $update_password_query_run = mysqli_query($connection, $update_password_query);
}
else {
    echo
    '<script>
        alert("Failed to edit the profile. Please try again.");
        return false;
    </script>';
}
mysqli_close($connection);
}
?>