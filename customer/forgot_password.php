<!DOCTYPE html>

<html lang="en">

<head>
    <title>Forgot Password</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <!-- Title -->
            <h1 class="mt-5 text-center"><b>Forgot Password</b></h1>
            <p class="mb-5 text-center">Send us your email and we will email you a link to reset your password.</p>

            <!-- Empty Space -->
            <div class="col-md-3 col-sm-3"></div>

            <form action="process.php" method="POST">
                <!-- Column -->
                <div class="col-md-6 col-sm-6">
                    <div class="form-group mt-3 mb-3">
                        <label for="email">Email *</label>
                        <input class="form-control rounded-input-box" type="email" name="email" placeholder="Email" autocomplete="off" required>
                    </div>

                    <div class="mt-5 mb-5">
                        <input class="btn btn-primary col-md-12 col-xs-12 mb-3" type="submit" name="submit_email_btn" value="Submit Email">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>