<?php

//Admin Logout
    session_start();
    unset($_SESSION['Email']);
    session_destroy();
    header('location:../admin_login.php');
?>