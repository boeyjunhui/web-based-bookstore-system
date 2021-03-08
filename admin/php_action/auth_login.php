<?php
include('db_connect.php');
//Admin login
if (isset($_POST['admin_login_btn']))
{
    session_start();

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $admin_query = "SELECT * FROM organization_member WHERE Email='$email' AND Password='$password'";

    if ($result = mysqli_query($connection, $admin_query))
    {
    $rowcount = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result))
        {
        $name1 = $row["FirstName"];
        $name2 = $row["LastName"];
        }

        if ($rowcount==1)
        {
            
        $_SESSION["Email"] = $email;
        $_SESSION["FullName"] = $name1." ".$name2; 

        echo '<script>window.location.href="../dashboard.php";</script>';
        }
        else
        {
        echo "<script>alert('Email or Password not matched! Please re login.'); window.location.href='../admin_login.php';</script>";
        
        }
    }
    mysqli_close($connection);
}


?>