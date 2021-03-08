<!DOCTYPE html>

<html lang="en">

<head>
    <title>View Profile</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

    // Validation for enter URL without login
    if (!$_SESSION['CustomerId']) {
        header('location: customer_login.php');
    }
    ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="text-center mt-5 mb-3"><b>My Profile</b></h1>

            <!-- Contact Information -->
            <?php
            $connection = mysqli_connect("localhost", "root", "", "book_republic");

            $query = "SELECT * FROM customer WHERE CustomerID='$_SESSION[CustomerId]'";
            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>

                    <div class="col-md-6 col-sm-6">
                        <h2 class="mt-5 mb-5">Contact Information</h2>

                        <div class="mt-3 mb-3">
                            <label for="first_name">First Name</label>
                            <h3><b><?php echo $row['FirstName']; ?></b></h3>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="last_name">Last Name</label>
                            <h3><b><?php echo $row['LastName']; ?></b></h3>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="contact_number">Contact Number</label>
                            <h3><b><?php echo $row['ContactNumber']; ?></b></h3>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="email">Email</label>
                            <h3><b><?php echo $row['Email']; ?></b></h3>
                        </div>
                    </div>

                    <!-- Billing Address -->
                    <div class="col-md-6 col-sm-6">
                        <h2 class="mt-5 mb-5">Billing Address</h2>

                        <div class="mt-3 mb-3">
                            <label for="street_address">Street Address</label>
                            <h3><b><?php echo $row['StreetAddress']; ?></b></h3>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="city">City</label>
                            <h3><b><?php echo $row['City']; ?></b></h3>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="state">State</label>
                            <h3><b><?php echo $row['State']; ?></b></h3>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="zip_code">Zip Code</label>
                            <h3><b><?php echo $row['ZipCode']; ?></b></h3>
                        </div>

                        <form action="edit_profile.php" method="POST">
                            <div class="mt-3 mb-3">
                                <input type="hidden" name="edit_profile" value="<?php echo $row['CustomerID']; ?>">
                                <input class="btn btn-primary col-md-3 col-xs-offset-5" type="submit" name="edit_profile_btn" value="Edit Profile">
                                <button class="btn btn-danger col-md-3 ml-3" formaction="process.php" onclick="return confirm('Are you sure to delete your account?');" name="delete_account_btn">Delete Account</button>
                            </div>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo "Profile information is not found.";
            }
            mysqli_close($connection);
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>