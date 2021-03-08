<?php
include("../db_connect.php");

if (isset($_POST['update_member_btn'])) {

$memberid = $_POST['memberid'];
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$email = $_POST['email'];
$contactnumber = $_POST['contact_number'];
$password = $_POST['confirm_new_password'];

$update_textbox_query = "UPDATE organization_member SET FirstName='$firstname', LastName='$lastname', Email='$email', 
ContactNumber='$contactnumber'
WHERE MemberID='$memberid'";
$update_textbox_query_run = mysqli_query($connection, $update_textbox_query);

$update_password_query = "UPDATE organization_member SET Password ='$password' WHERE MemberID='$memberid'";
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
