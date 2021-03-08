<!DOCTYPE html>

<html lang="en">

<head>
    <title>Login</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="mt-5 text-center"><b>Login to your account</b></h1>
            <p class="mb-5 text-center">New User? <a href="sign_up.php">Sign Up</a></p>

            <!-- Empty Space -->
            <div class="col-md-3 col-sm-3"></div>

            <form action="process.php" method="POST" onSubmit="return validate_customer_login();">
                <!-- Column -->
                <div class="col-md-6 col-sm-6">
                    <div class="form-group mt-3 mb-3">
                        <label for="email">Email *</label>
                        <a href="forgot_password.php">Forgot Password?</a>
                        <input id="email" class="form-control rounded-input-box" type="email" name="email" autocomplete="off" required>
                    </div>

                    <div class="form-group mt-3 mb-3">
                        <label for="password">Password *</label>
                        <input id="password" class="form-control rounded-input-box" type="password" name="password" autocomplete="off" required>
                    </div>

                    <div class="mt-5 mb-5">
                        <input class="btn btn-primary col-md-12 col-xs-12 mb-3" type="submit" name="customer_login_btn" value="Login">
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