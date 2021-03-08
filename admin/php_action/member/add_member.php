<?php

include("../db_connect.php");

if (isset($_POST['add_member_btn'])) {

    $query = "INSERT INTO organization_member (FirstName, LastName, Email, ContactNumber, Password) 
    VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[contact_number]','$_POST[confirm_new_password]')";

    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        echo 
        '<script>
            alert("Added member successfully.");
            window.location.href="../../member_view.php";
        </script>';
      } else {
        echo 
        '<script>
            alert("Failed to add member. Please try again.");
            return false;
        </script>';
        
    }
    mysqli_close($connection);
}
?>