<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Header</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@550&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">

    <!-- Font Awesome 4 Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="css/responsive.css" type="text/css" rel="stylesheet">
</head>

<body>
    <!-- Top Header -->
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <?php
                            if (isset($_SESSION['CustomerId'])) {
                                echo '<li><a href="view_profile.php"><i class="fa fa-user-o"></i> View Profile</a></li>';
                            }

                            if (!isset($_SESSION['CustomerId'])) {
                                echo '<li><a href="customer_login.php"><i class="fa fa-user-circle-o"></i> Login / Sign Up</a></li>';
                            }

                            if (isset($_SESSION['CustomerId'])) {
                                echo '<li>';
                                echo '<form action="process.php" method="POST">';
                                echo '<button class="btn-no-border" onClick="return confirm(\'Would you like to logout?\');" type="submit" name="logout_btn"><i class="fa fa-sign-out"></i> Logout</button>';
                                echo '</form>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookstore Logo -->
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo navbar-header">
                        <a href="homepage.php"><img src="image/book_republic_logo.png" alt="Book Republic" width="400px" height="100px"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="text-center navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="homepage.php">Home</a></li>
                        <li>
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Book Categories</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="book_comic.php">Comic</a>
                                <a class="dropdown-item" href="book_fiction.php">Fiction</a>
                                <a class="dropdown-item" href="book_graphic_novel.php">Graphic Novel</a>
                                <a class="dropdown-item" href="book_reference.php">Reference</a>
                                <a class="dropdown-item" href="book_technology.php">Technology</a>
                            </div>
                        </li>
                        <li><a href="orders.php">Orders</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="about_us.php">About Us</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="shopping_cart.php"><i class="fa fa-shopping-cart fa-lg"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>