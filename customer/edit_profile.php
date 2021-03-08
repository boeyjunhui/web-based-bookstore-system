<!DOCTYPE html>

<html lang="en">

<head>
    <title>Edit Profile</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: homepage.php');
    }
    ?>

    <!-- Content -->
    <?php
    $connection = mysqli_connect("localhost", "root", "", "book_republic");

    if (isset($_POST['edit_profile_btn'])) {
        $id = $_POST['edit_profile'];

        $query = "SELECT * FROM customer WHERE CustomerID='$id'";
        $query_run = mysqli_query($connection, $query);

        foreach ($query_run as $row) {
    ?>

            <div class="container">
                <div class="row">
                    <!-- Title -->
                    <h1 class="text-center mt-5 mb-5"><b>Edit Profile</b></h1>

                    <form action="process.php" method="POST" onSubmit="return validate_customer_edit_profile();">

                        <!-- Contact Information -->
                        <div class="col-md-6 col-sm-6">
                            <h3 class="mt-5 mb-3"><b>Contact Information</b></h3>

                            <input type="hidden" name="id" value="<?php echo $row['CustomerID']; ?>">

                            <div class="form-group mt-3 mb-3">
                                <label for="first_name">First Name *</label>
                                <input id="firstname" class="form-control rounded-input-box" type="text" name="first_name" value="<?php echo $row['FirstName']; ?>" placeholder="First Name" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="last_name">Last Name *</label>
                                <input id="lastname" class="form-control rounded-input-box" type="text" name="last_name" value="<?php echo $row['LastName']; ?>" placeholder="Last Name" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="contact_number">Contact Number *</label>
                                <input id="phone" class="form-control rounded-input-box" type="tel" name="contact_number" value="<?php echo $row['ContactNumber']; ?>" placeholder="Contact Number" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="email">Email *</label>
                                <input id="email" class="form-control rounded-input-box" type="email" name="email" value="<?php echo $row['Email']; ?>" placeholder="Email" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="password">Password *</label>
                                <input id="password" class="form-control rounded-input-box" type="password" name="password" value="<?php echo $row['Password']; ?>" placeholder="Password" autocomplete="off" required>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="col-md-6 col-sm-6">
                            <h3 class="mt-5 mb-3"><b>Billing Address</b></h3>

                            <div class="form-group mt-3 mb-3">
                                <label for="street_address">Street Address *</label>
                                <input class="form-control rounded-input-box" type="text" name="street_address" value="<?php echo $row['StreetAddress']; ?>" placeholder="Street Address" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="city">City *</label>
                                <input id="city" class="form-control rounded-input-box" type="text" name="city" value="<?php echo $row['City']; ?>" placeholder="City" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="state">State *</label>
                                <input id="state" class="form-control rounded-input-box" type="text" name="state" value="<?php echo $row['State']; ?>" placeholder="State" autocomplete="off" required>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <label for="zip_code">Zip Code *</label>
                                <input id="zipcode" class="form-control rounded-input-box" type="number" name="zip_code" value="<?php echo $row['ZipCode']; ?>" placeholder="Zip Code" autocomplete="off" required>
                            </div>

                    <?php
                }
                mysqli_close($connection);
            }
                    ?>

                    <div class="mt-5 mb-3">
                        <a href="view_profile.php" class="btn btn-danger col-md-3 col-xs-offset-5" name="cancel_edit_profile_btn">Cancel</a>
                        <input class="btn btn-primary col-md-3 ml-3" type="submit" name="update_profile_btn" value="Save">
                    </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <?php include "footer.php"; ?>

            <!-- JavaScript Validation -->
            <script src="js/validation.js"></script>
</body>

</html>