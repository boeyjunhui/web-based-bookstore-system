<?php
    session_start();
    // Validation for enter URL without login
    if(!isset($_SESSION['Email'])) {
       
        echo "<script>alert('Please login!'); window.location.href='admin_login.php';</script>";
        
    }
?>