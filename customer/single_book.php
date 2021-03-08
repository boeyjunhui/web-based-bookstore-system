<!DOCTYPE html>

<html lang="en">

<head>
    <title>Shop Book</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

    // Validation for direct URL entry
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('location: homepage.php');
    }

    // Validation for add to cart button if not logged in
    if (!isset($_SESSION['CustomerId']) && isset($_POST['add_to_cart_btn'])) {
        echo
        '<script>
            alert("Please login to add to cart.");
            history.back();
        </script>';
        return false;
    }

    // Cart session
    if (isset($_SESSION['CustomerId']) && isset($_SESSION['shopping_cart'])) {
        $_SESSION['shopping_cart'];
    }
    ?>

    <!-- Content -->
    <!-- Book -->
    <div class="book-category">
        <div class="container">
            <div class="row">
                <h1 class="text-center mt-5 mb-5" style="color: white;">Book</h1>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a class="btn btn-default mt-5" href="javascript:history.back()"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
        </div>
    </div>

    <!-- Single Book -->
    <div class="container">
        <div class="row">

            <?php
            $connection = mysqli_connect("localhost", "root", "", "book_republic");

            if (isset($_GET['bookid'])) {
                $bookid = $_GET['bookid'];

                $query = "SELECT * FROM book WHERE BookID = '$bookid'";
                $query_run = mysqli_query($connection, $query);

                if ($row = mysqli_fetch_assoc($query_run)) {
            ?>

                    <!-- Book Image -->
                    <div class="col-sm-6 mt-5">
                        <form action="single_book.php" method="POST" enctype="multipart/form-data">
                            <?php echo '<img src=data:image;base64,' . base64_encode($row['Image']) . ' width="300px" height="450px" alt="Book Image">'; ?>
                        </form>
                    </div>

                    <div class="col-sm-6">
                        <div class="product-inner">
                            <!-- Book Title, Price, Quantity in Stock & Average Rating -->
                            <h1 class="book-title mt-5"><b><?php echo $row['Title']; ?></b></h1>
                            <h2 class="book-price">RM <?php echo $row['SalePrice']; ?></h2>
                            <?php
                            if ($row['StockQuantity'] > 0) {
                                echo '<p>In stock: ' . $row['StockQuantity'] . '</p>';
                            } else {
                                echo '<p style="color: #ff0000;">Out of stock</p>';
                            }
                            ?>
                            <p>Rating:
                                <?php
                                $average_rating_query = "SELECT (SUM(rating.Rate) + book.Rating) / (COUNT(rating.Rate) + 1) AS average FROM rating
                                INNER JOIN book ON rating.BookID = book.BookID
                                WHERE rating.BookID = '$bookid'";

                                $average_rating_query_run = mysqli_query($connection, $average_rating_query);

                                $average_rating_row = mysqli_fetch_assoc($average_rating_query_run);
                                $average_rating = number_format($average_rating_row['average'], 1);

                                if ($average_rating != 0) {
                                    echo $average_rating;
                                } else {
                                    echo number_format($row['Rating'], 1);
                                }
                                ?>
                            </p>

                            <!-- Book Quantity & Add to Cart Button -->
                            <form class="mt-3 mb-3" method="POST">
                                <input class="col-md-2 col-sm-4 rounded-input-box" type="number" name="quantity" value="1" min="1" max="10">&emsp;
                                <input type="hidden" name="book_id" value="<?php echo $row['BookID']; ?>">
                                <input class="btn btn-primary" type="submit" name="add_to_cart_btn" value="Add to Cart">
                                <?php
                                // Add item to cart
                                if (isset($_POST['add_to_cart_btn'])) {

                                    $id = $_POST['book_id'];
                                    $quantity = $_POST['quantity'];

                                    if (($quantity > 0 && $quantity > $row['StockQuantity']) && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                                        echo
                                        '<script>
                                            alert("Failed to add book! You have entered a number that exceed the stock.");
                                            history.back();
                                        </script>';
                                    } else if ($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                                        if (isset($_SESSION['shopping_cart'][$id])) {
                                            echo
                                            '<script>
                                                alert("Failed to add book! Book is already exist in the shopping cart.");
                                                history.back();
                                            </script>';
                                        } else {
                                            $_SESSION['shopping_cart'][$id] = $quantity;

                                            echo
                                            '<script>
                                                alert("Book is added to the shopping cart successfully.");
                                                history.back();
                                            </script>';
                                        }
                                    } else if ($row['BookID'] == $id && $row['StockQuantity'] == 0) {
                                        echo
                                        '<script>
                                            alert("Failed to add book! The book is out of stock.");
                                            history.back();
                                        </script>';
                                    }
                                }
                                ?>
                            </form>

                            <!-- Book Details -->
                            <p>Category: <?php echo $row['Category']; ?></p>
                            <p>ISBN13: <?php echo $row['ISBN13']; ?></p>
                            <p>Author: <?php echo $row['Author']; ?></p>
                            <p>Publisher: <?php echo $row['Publisher']; ?></p>
                            <p>Publication Date: <?php echo $row['PublicationDate']; ?></p>
                            <p>Format: <?php echo $row['Format']; ?></p>
                            <p>Dimensions: <?php echo $row['Dimensions']; ?></p>
                            <p>Weight: <?php echo $row['Weight']; ?></p>

                            <!-- Book Description & Rating -->
                            <div>
                                <ul class="product-tab mt-5">
                                    <li class="active"><a href="#book_description" data-toggle="tab">Book Description</a></li>
                                    <li><a href="#book_rating" data-toggle="tab">Book Rating</a></li>
                                </ul>

                                <div class="tab-content">
                                    <!-- Book Description -->
                                    <div class="tab-pane fade in active" id="book_description">
                                        <p class="text-justify"><?php echo $row['Description']; ?></p>
                                    </div>

                                    <!-- Book Rating -->
                                    <div class="tab-pane fade" id="book_rating">

                                        <?php
                                        if (isset($_SESSION['CustomerId'])) {
                                            echo '<p>Your rating</p>';
                                        } else {
                                            echo '<p>Please login to view and add rating.</p>';
                                        }
                                        ?>

                                        <form action="process.php" method="POST">
                                            <div class="star-container mb-3">
                                                <div class="star">

                                                    <?php
                                                    if (isset($_SESSION['CustomerId'])) {

                                                        $customerid = $_SESSION['CustomerId'];

                                                        $rating_query = "SELECT * FROM rating WHERE CustomerID='$customerid' AND BookID='$bookid'";
                                                        $rating_query_run = mysqli_query($connection, $rating_query);
                                                        $rating_row_count = mysqli_num_rows($rating_query_run);

                                                        if ($rating_row_count == 0) {
                                                            echo '<input id="rate-1" type="radio" name="rate" value="5" required>';
                                                            echo '<label for="rate-1" class="fa fa-star"></label>';
                                                            echo '<input id="rate-2" type="radio" name="rate" value="4" required>';
                                                            echo '<label for="rate-2" class="fa fa-star"></label>';
                                                            echo '<input id="rate-3" type="radio" name="rate" value="3" required>';
                                                            echo '<label for="rate-3" class="fa fa-star"></label>';
                                                            echo '<input id="rate-4" type="radio" name="rate" value="2" required>';
                                                            echo '<label for="rate-4" class="fa fa-star"></label>';
                                                            echo '<input id="rate-5" type="radio" name="rate" value="1" required>';
                                                            echo '<label for="rate-5" class="fa fa-star"></label>';
                                                        } else {
                                                            if ($rating_row = mysqli_fetch_assoc($rating_query_run)) {
                                                                if ($rating_row['Rate'] == 5) {
                                                                    echo '<input id="rate-1" type="radio" name="rate" value="5" checked required>';
                                                                    echo '<label for="rate-1" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-2" type="radio" name="rate" value="4" required>';
                                                                    echo '<label for="rate-2" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-3" type="radio" name="rate" value="3" required>';
                                                                    echo '<label for="rate-3" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-4" type="radio" name="rate" value="2" required>';
                                                                    echo '<label for="rate-4" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-5" type="radio" name="rate" value="1" required>';
                                                                    echo '<label for="rate-5" class="fa fa-star"></label>';
                                                                } else if ($rating_row['Rate'] == 4) {
                                                                    echo '<input id="rate-1" type="radio" name="rate" value="5" required>';
                                                                    echo '<label for="rate-1" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-2" type="radio" name="rate" value="4" checked required>';
                                                                    echo '<label for="rate-2" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-3" type="radio" name="rate" value="3" required>';
                                                                    echo '<label for="rate-3" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-4" type="radio" name="rate" value="2" required>';
                                                                    echo '<label for="rate-4" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-5" type="radio" name="rate" value="1" required>';
                                                                    echo '<label for="rate-5" class="fa fa-star"></label>';
                                                                } else if ($rating_row['Rate'] == 3) {
                                                                    echo '<input id="rate-1" type="radio" name="rate" value="5" required>';
                                                                    echo '<label for="rate-1" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-2" type="radio" name="rate" value="4" required>';
                                                                    echo '<label for="rate-2" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-3" type="radio" name="rate" value="3" checked required>';
                                                                    echo '<label for="rate-3" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-4" type="radio" name="rate" value="2" required>';
                                                                    echo '<label for="rate-4" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-5" type="radio" name="rate" value="1" required>';
                                                                    echo '<label for="rate-5" class="fa fa-star"></label>';
                                                                } else if ($rating_row['Rate'] == 2) {
                                                                    echo '<input id="rate-1" type="radio" name="rate" value="5" required>';
                                                                    echo '<label for="rate-1" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-2" type="radio" name="rate" value="4" required>';
                                                                    echo '<label for="rate-2" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-3" type="radio" name="rate" value="3" required>';
                                                                    echo '<label for="rate-3" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-4" type="radio" name="rate" value="2" checked required>';
                                                                    echo '<label for="rate-4" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-5" type="radio" name="rate" value="1" required>';
                                                                    echo '<label for="rate-5" class="fa fa-star"></label>';
                                                                } else if ($rating_row['Rate'] == 1) {
                                                                    echo '<input id="rate-1" type="radio" name="rate" value="5" required>';
                                                                    echo '<label for="rate-1" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-2" type="radio" name="rate" value="4" required>';
                                                                    echo '<label for="rate-2" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-3" type="radio" name="rate" value="3" required>';
                                                                    echo '<label for="rate-3" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-4" type="radio" name="rate" value="2" required>';
                                                                    echo '<label for="rate-4" class="fa fa-star"></label>';
                                                                    echo '<input id="rate-5" type="radio" name="rate" value="1" checked required>';
                                                                    echo '<label for="rate-5" class="fa fa-star"></label>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                            <?php
                                            if (isset($_SESSION['CustomerId'])) {

                                                $customerid = $_SESSION['CustomerId'];

                                                $rating_query = "SELECT * FROM rating WHERE CustomerID='$customerid' AND BookID='$bookid'";
                                                $rating_query_run = mysqli_query($connection, $rating_query);
                                                $rating_row_count = mysqli_num_rows($rating_query_run);

                                                if ($rating_row_count == 0) {
                                                    echo '<input type="hidden" name="book_id" value="' . $row['BookID'] . '">';
                                                    echo '<input class="btn btn-primary" type="submit" name="rate_btn" value="Rate">&ensp;';
                                                } else {
                                                    echo '<input type="hidden" name="book_id" value="' . $row['BookID'] . '">';
                                                    echo '<input class="btn btn-info" type="submit" name="update_rating_btn" value="Update Rating">&ensp;';
                                                    echo '<input class="btn btn-danger" type="submit" name="delete_rating_btn" value="Delete Rating">';
                                                }
                                            }
                                            ?>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "Book catalog is not found.";
            }
            mysqli_close($connection);
            ?>

        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>

</html>