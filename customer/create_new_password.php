<!DOCTYPE html>

<html lang="en">

<head>
    <title>Create New Password</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="mt-5 text-center"><b>Create New Password</b></h1>
            <p class="mb-5 text-center">Please enter your new password.</p>

            <!-- Empty Space -->
            <div class="col-md-3 col-sm-3"></div>

            <form method="POST">
                <!-- Column -->
                <div class="col-md-6 col-sm-6">
                    <div class="form-group mt-3 mb-3">
                        <label for="new_password">New Password *</label>
                        <input class="form-control rounded-input-box" id="new-password" type="password" name="new_password" placeholder="New password" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="confirm_new_password">Confirm New Password *</label>
                        <input class="form-control rounded-input-box" id="confirm-new-password" type="password" name="confirm_new_password" placeholder="Confirm new password" autocomplete="off" required>
                    </div>

                    <div class="mt-5 mb-5">
                        <input class="btn btn-primary col-md-12 col-xs-12" id="change-password" type="submit" name="change_password_btn" value="Change Password">
                    </div>
                </div>
            </form>

            <!-- Change Password Process -->
            <?php
            $connection = mysqli_connect("localhost", "root", "", "book_republic");

            if (!$connection) {
                echo "There is error connecting to the database." . mysqli_error($connection);
            }

            if (!isset($_GET["token"])) {
                echo "Page could not be found.";
            }

            $token = $_GET["token"];

            $query = "SELECT Email FROM reset_password WHERE Token = '$token'";
            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) == 0) {
                echo "Page could not be found.";
            }

            if (isset($_POST["change_password_btn"])) {

                $password = $_POST["new_password"];
                $row = mysqli_fetch_array($query_run);
                $email = $row["Email"];

                $update_query = "UPDATE customer SET Password = '$password' WHERE Email = '$email'";
                $update_query_run = mysqli_query($connection, $update_query);

                if ($update_query_run) {
                    $delete_query = "DELETE FROM reset_password WHERE Token = '$token'";
                    $delete_query_run = mysqli_query($connection, $delete_query);

                    echo
                    '<script>
                        alert("Your password has changed successfully.");
                        window.location.href="customer_login.php";
                    </script>';
                } else {
                    echo
                    '<script>
                        alert("Error! Failed to change password. Try again.");
                        window.location.href="create_new_password.php";
                    </script>';
                }
            }
            mysqli_close($connection);
            ?>

        </div>
    </div>

    <!-- Validate password matching -->
    <script>
        document.querySelector('#change-password').onclick = function() {
            var new_password = document.querySelector('#new-password').value;
            var confirm_new_password = document.querySelector('#confirm-new-password').value;

            if (new_password != confirm_new_password) {
                alert("New password and confirm new password are not matched. Please try again.");
                return false;
            } else if (new_password == confirm_new_password) {
                return true;
            }
        }
    </script>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>