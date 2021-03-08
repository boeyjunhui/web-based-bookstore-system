<?php
session_start();

// Validation for direct URL entry
if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: homepage.php');
}

$connection = mysqli_connect("localhost", "root", "", "book_republic");

if (!$connection) {
    echo "There is error connecting to the database." . mysqli_error($connection);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


// Customer sign up
if (isset($_POST['register_btn'])) {

    $email = $_POST['email'];

    $select_query = "SELECT * FROM customer WHERE Email='$email'";
    $select_query_run = mysqli_query($connection, $select_query);
    $email_row_count = mysqli_num_rows($select_query_run);

    if ($email_row_count > 0) {
        echo
        '<script>
            alert("Failed to sign up. Email is already exist. Try another email.");
            window.location.href="sign_up.php";
        </script>';
    } else {
        $query = "INSERT INTO customer (FirstName, LastName, ContactNumber, Email, Password, StreetAddress, City, State, ZipCode, AccountStatus)
        VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[contact_number]','$email','$_POST[password]','$_POST[street_address]','$_POST[city]','$_POST[state]','$_POST[zip_code]', 'Enabled')";

        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Sign up complete!");
                window.location.href="sign_up.php";
            </script>';
        } else {
            echo
            '<script>
                alert("Sorry, there is an issue while trying to sign up, please try again.");
                window.location.href="sign_up.php";
            </script>';
        }
    }
    mysqli_close($connection);
}


// Submit email, check email, and send reset password email link to customer
if (isset($_POST["submit_email_btn"])) {

    $email = $_POST["email"];

    $query = "SELECT Email FROM customer WHERE Email = '$email'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $email_to = $_POST["email"];
        $token = uniqid(true);

        $insert_query = "INSERT INTO reset_password (Email, Token) VALUES ('$email_to', '$token')";
        $insert_query_run = mysqli_query($connection, $insert_query);

        if (!$insert_query) {
            echo
            '<script>
                alert("Something went wrong. Reset password email could not be processed.");
                window.location.href="forgot_password.php";
            <script>';
        }

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bookrepublic6@gmail.com';
            $mail->Password   = 'bookrepublic123';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('bookrepublic6@gmail.com', 'Book Republic');
            $mail->addAddress($email_to);
            $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

            // Content
            $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/create_new_password.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = "Reset Password";
            $mail->Body    = "<h3>You have requested a password reset.</h3><p>You may click <a href='$url'>this link</a> to reset your password.</p>";

            $mail->send();

            echo
            '<script>
                alert("An email with the reset password link is sent to you.");
                window.location.href="forgot_password.php";
            </script>';
        } catch (Exception $e) {
            echo
            '<script>
                alert("Something went wrong. Reset password email could not be sent.");
                window.location.href="forgot_password.php";
            </script>';
            "Mailer Error: {$mail->ErrorInfo}";
        }
        exit();
    } else {
        echo
        '<script>
            alert("Sorry, the email you entered does not exist in the database.");
            window.location.href="forgot_password.php";
        </script>';
    }
    mysqli_close($connection);
}


// Customer login
if (isset($_POST['customer_login_btn'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $customer_query = "SELECT * FROM customer WHERE Email='$email' AND Password='$password' AND AccountStatus='Enabled'";
    $customer_query_run = mysqli_query($connection, $customer_query);

    if (mysqli_num_rows($customer_query_run) > 0) {
        while ($row = mysqli_fetch_assoc($customer_query_run)) {
            $_SESSION['CustomerId'] = $row['CustomerID'];
        }

        header('location: homepage.php');
    } else {
        echo
        '<script>
            alert("Email or password is invalid. Failed to login, please try again.");
            window.location.href="customer_login.php";
        </script>';
    }
    mysqli_close($connection);
}


// Customer logout
if (isset($_POST['logout_btn'])) {
    session_destroy();
    header('location: customer_login.php');
}


// Edit profile
if (isset($_POST['update_profile_btn'])) {

    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];

    $query = "UPDATE customer SET FirstName='$first_name', LastName='$last_name', ContactNumber='$contact_number', Email='$email',  Password='$password', StreetAddress='$street_address', City='$city', State='$state', ZipCode='$zip_code' WHERE CustomerID='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo
        '<script>
            alert("Your profile is updated successfully.");
            window.location.href="view_profile.php";
        </script>';
    } else {
        echo
        '<script>
            alert("Failed to update your profile. Try again.");
            window.location.href="edit_profile.php";
        </script>';
    }
    mysqli_close($connection);
}


// Contact
if (isset($_POST["submit_contact_btn"])) {

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $reason = $_POST['reason'];
    $message = addslashes($_POST['message']);

    $query = "INSERT INTO contact (FullName, Email, ContactNumber, Reason, Message, Status) VALUES ('$full_name', '$email', '$contact_number', '$reason', '$message', 'Not Seen')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo
        '<script>
            alert("Your message has been sent.");
            window.location.href="contact.php";
        </script>';
    } else {
        echo
        '<script>
            alert("Failed to send your message. Try again.");
            window.location.href="contact.php";
        </script>';
    }
    mysqli_close($connection);
}


// Rating (insert)
if (isset($_SESSION['CustomerId']) && isset($_POST["rate_btn"])) {

    $customerid = $_SESSION['CustomerId'];
    $bookid = $_POST['book_id'];
    $rate = $_POST['rate'];

    $select_query = "SELECT * FROM rating WHERE CustomerID = '$customerid' AND BookID = '$bookid'";
    $select_query_run = mysqli_query($connection, $select_query);
    $rating_row_count = mysqli_num_rows($select_query_run);

    if ($rating_row_count > 0) {
        echo
        '<script>
            alert("Failed to add rating. Rating is already exist.");
            history.back();
        </script>';
    } else {
        $query = "INSERT INTO rating (CustomerID, BookID, Rate, Date) VALUES ('$customerid', '$bookid', '$rate', CURDATE())";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo
            '<script>
                alert("Thank you for your rating.");
                history.back();
            </script>';
        } else {
            echo
            '<script>
                alert("Failed to add rating. Try again.");
                history.back();
            </script>';
        }
    }
    mysqli_close($connection);
}


// Rating (update)
if (isset($_SESSION['CustomerId']) && isset($_POST["update_rating_btn"])) {

    $customerid = $_SESSION['CustomerId'];
    $bookid = $_POST['book_id'];
    $rate = $_POST['rate'];

    $query = "UPDATE rating SET Rate='$rate' WHERE CustomerID='$customerid' AND BookID='$bookid'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo
        '<script>
            alert("Your rating has been updated.");
            history.back();
        </script>';
    } else {
        echo
        '<script>
            alert("Failed to update your rating. Try again.");
            history.back();
        </script>';
    }

    mysqli_close($connection);
}


// Rating (delete)
if (isset($_SESSION['CustomerId']) && isset($_POST["delete_rating_btn"])) {

    $customerid = $_SESSION['CustomerId'];
    $bookid = $_POST['book_id'];
    $rate = $_POST['rate'];

    $query = "DELETE FROM rating WHERE CustomerID='$customerid' AND BookID='$bookid'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo
        '<script>
            alert("Your rating has been deleted.");
            history.back();
        </script>';
    } else {
        echo
        '<script>
            alert("Failed to delete your rating. Try again.");
            history.back();
        </script>';
    }
    mysqli_close($connection);
}


// Payment & place order
if (isset($_POST["place_order_btn"])) {

    $customerid = $_SESSION['CustomerId'];
    $grandtotal = $_SESSION['grand_total'];
    $ordernumber = mt_rand(00000, 99999);
    $successful = TRUE;

    $new_order_query = "INSERT INTO new_order (CustomerID, OrderNumber, Date, Time, DeliveryAddress, PaymentMethod, GrandTotal, Status)
    VALUES ('$customerid', '$ordernumber', CURDATE(), CURRENT_TIME(), '$_POST[delivery_address]', '$_POST[payment_method]', '$grandtotal', 'Awaiting Payment')";
    $new_order_query_run = mysqli_query($connection, $new_order_query);

    $select_query = "SELECT OrderID FROM new_order WHERE CustomerID='$customerid'";
    $select_query_run = mysqli_query($connection, $select_query);

    $orderid = 0;

    if (mysqli_num_rows($select_query_run) > 0) {
        while ($row = mysqli_fetch_assoc($select_query_run)) {
            $orderid = $row['OrderID'];
        }
    }

    foreach ($_SESSION['shopping_cart'] as $id => $quantity) {
        $order_item_query = "INSERT INTO order_item (OrderID, BookID, Quantity) VALUES ('$orderid', '$id', '$quantity')";
        $order_item_query_run = mysqli_query($connection, $order_item_query);

        if (!$order_item_query_run) {
            $successful = FALSE;
        }
    }

    if ($new_order_query_run) {
        echo
        '<script>
            alert("Order is placed successfully.");
            window.location.href="thank_you.php";
        </script>';
    } else {
        $successful = FALSE;

        echo
        '<script>
            alert("Failed to place order. Try again.");
            window.location.href="payment.php";
        </script>';
    }

    if ($successful == TRUE) {
        unset($_SESSION['shopping_cart']);
    }
    mysqli_close($connection);
}


// Cancel order
if (isset($_POST["cancel_order_btn"])) {

    $order_id = $_POST['order_id'];

    $query = "UPDATE new_order SET Status='Cancelled' WHERE OrderID='$order_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo
        '<script>
            alert("Your order has been cancelled.");
            window.location.href="orders.php";
        </script>';
    } else {
        echo
        '<script>
            alert("Failed to cancel your order. Try again.");
            window.location.href="orders.php";
        </script>';
    }
    mysqli_close($connection);
}


// Delete account
if (isset($_POST["delete_account_btn"])) {

    $customerid = $_SESSION['CustomerId'];

    $query = "UPDATE customer SET AccountStatus='Disabled' WHERE CustomerID='$customerid'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        unset($_SESSION['CustomerId']);
        echo
        '<script>
            alert("Your account has been deleted.");
            window.location.href="customer_login.php";
        </script>';
    } else {
        echo
        '<script>
            alert("Failed to delete your account. Try again.");
            window.location.href="view_profile.php";
        </script>';
    }
    mysqli_close($connection);
}
