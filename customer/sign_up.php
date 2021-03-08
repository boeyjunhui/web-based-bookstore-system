<!DOCTYPE html>

<html lang="en">

<head>
    <title>Sign Up</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="text-center mt-5"><b>Create A New Account</b></h1>
            <p class="text-center mb-5">Already have an account? <a href="customer_login.php">Sign In</a></p>

            <form action="process.php" method="POST" onSubmit="return validate_customer_sign_up();">
                <!-- Contact Information -->
                <div class="col-md-6 col-sm-6">
                    <h3 class="mt-5 mb-3"><b>Contact Information</b></h3>

                    <div class="form-group mt-3 mb-3">
                        <label for="first_name">First Name *</label>
                        <input id="firstname" class="form-control rounded-input-box" type="text" name="first_name" placeholder="First Name" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="last_name">Last Name *</label>
                        <input id="lastname" class="form-control rounded-input-box" type="text" name="last_name" placeholder="Last Name" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="contact_number">Contact Number *</label>
                        <input id="phone" class="form-control rounded-input-box" type="tel" name="contact_number" placeholder="Contact Number" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="email">Email *</label>
                        <input id="email" class="form-control rounded-input-box" type="email" name="email" placeholder="Email" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="password">Password *</label>
                        <input id="password" class="form-control rounded-input-box" type="password" name="password" placeholder="Password" autocomplete="off" required>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="col-md-6 col-sm-6">
                    <h3 class="mt-5 mb-3"><b>Billing Address</b></h3>

                    <div class="form-group mt-3 mb-3">
                        <label for="street_address">Street Address *</label>
                        <input class="form-control rounded-input-box" type="text" name="street_address" placeholder="Street Address" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="city">City *</label>
                        <input id="city" class="form-control rounded-input-box" type="text" name="city" placeholder="City" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="state">State *</label>
                        <input id="state" class="form-control rounded-input-box" type="text" name="state" placeholder="State" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="zip_code">Zip Code *</label>
                        <input id="zipcode" class="form-control rounded-input-box" type="number" name="zip_code" placeholder="Zip Code" autocomplete="off" required>
                    </div>

                    <div class="mt-5 mb-3">
                        <input class="btn btn-primary col-md-3 col-xs-offset-9" type="submit" name="register_btn" value="Register">
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