<!DOCTYPE html>

<html lang="en">

<head>
    <title>Contact</title>
</head>

<body>
    <!-- Header -->
    <?php include "header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <h1 class="mt-5 mb-5 text-center"><b>Contact Us</b></h1>

            <form action="process.php" method="POST" onSubmit="return validate_customer_contact();">
                <!-- First Column -->
                <div class="col-md-6 col-sm-6">
                    <!-- Full Name -->
                    <div class="form-group mt-3 mb-3">
                        <label for="full_name">Full Name *</label>
                        <input id="name" class="form-control rounded-input-box" type="text" name="full_name" placeholder="Full Name" autocomplete="off" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mt-3 mb-3">
                        <label for="email">Email *</label>
                        <input id="email" class="form-control rounded-input-box" type="email" name="email" placeholder="Email" autocomplete="off" required>
                    </div>

                    <!-- Contact Number -->
                    <div class="form-group mt-3 mb-3">
                        <label for="contact_number">Contact Number *</label>
                        <input id="phone" class="form-control rounded-input-box" type="tel" name="contact_number" placeholder="Contact Number" autocomplete="off" required>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-md-6 col-sm-6">
                    <!-- Reason -->
                    <div class="form-group mt-3 mb-3">
                        <label for="reason">Reason *</label>
                        <select class="form-control rounded-input-box" name="reason" autocomplete="off" required>
                            <option value="">Please select a reason...</option>
                            <option value="Account">Account</option>
                            <option value="Payment">Payment</option>
                            <option value="Order">Order</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Feedback">Feedback</option>
                            <option value="Issue">Issue</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div class="form-group mt-3 mb-3">
                        <label for="message">Message *</label>
                        <textarea class="form-control rounded-input-box" name="message" rows="6" placeholder="Type your message..." autocomplete="off" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-3 mb-3">
                        <input class="btn btn-primary col-md-3 col-xs-offset-9" type="submit" name="submit_contact_btn" value="Submit">
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