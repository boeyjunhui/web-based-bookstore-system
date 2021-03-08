<!DOCTYPE html>

<html lang="en">

<head>
    <title>Home - Book Republic</title>
</head>

<body>
    <?php
    // Header
    include "header.php";

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
    <!-- Slider -->
    <div class="slider-area">
        <div class="block-slider">
            <ul id="bxslider-home4">
                <li><a href="book_comic.php"><img class="homepage-image" src="image/comic.jpg" alt="Book Image"></a></li>
                <li><a href="book_fiction.php"><img class="homepage-image" src="image/fiction.jpg" alt="Book Image"></a></li>
                <li><a href="book_graphic_novel.php"><img class="homepage-image" src="image/graphic_novel.jpg" alt="Book Image"></a></li>
                <li><a href="book_reference.php"><img class="homepage-image" src="image/reference.jpg" alt="Book Image"></a></li>
                <li><a href="book_technology.php"><img class="homepage-image" src="image/technology.jpg" alt="Book Image"></a></li>
            </ul>
        </div>
    </div>

    <!-- Book Catalog -->
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <!-- Title -->
                <h1 class="mt-5 mb-5 text-center">Book</h1>

                <?php
                $connection = mysqli_connect("localhost", "root", "", "book_republic");

                $query = "SELECT * FROM book LIMIT 4";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <form action="homepage.php" method="POST" enctype="multipart/form-data">
                                    <?php echo '<img src=data:image;base64,' . base64_encode($row['Image']) . ' width="200px" height="300px" alt="Book Image">'; ?>
                                </form>
                                <form action="single_book.php" method="GET">
                                    <div class="book-title-container">
                                        <h3 class="book-title mt-3"><a href="single_book.php?bookid=<?php echo $row['BookID']; ?>"><?php echo $row['Title']; ?></a></h3>
                                    </div>
                                </form>
                                <p>RM <?php echo $row['SalePrice']; ?></p>
                                <?php
                                if ($row['StockQuantity'] > 0) {
                                    echo '<p>In stock: ' . $row['StockQuantity'] . '</p>';
                                } else {
                                    echo '<p style="color: #ff0000;">Out of stock</p>';
                                }
                                ?>

                                <form action="homepage.php" method="POST">
                                    <input class="col-md-3 mt-3 rounded-input-box" type="number" name="quantity" value="1" min="1" max="10">&emsp;
                                    <input type="hidden" name="book_id" value="<?php echo $row['BookID']; ?>">
                                    <input class="btn btn-primary mt-3" type="submit" name="add_to_cart_btn" value="Add to Cart">
                                    <?php
                                    // Add item to cart
                                    if (isset($_POST['add_to_cart_btn'])) {

                                        $id = $_POST['book_id'];
                                        $quantity = $_POST['quantity'];

                                        if (($quantity > 0 && $quantity > $row['StockQuantity']) && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                                            echo
                                            '<script>
                                                alert("Failed to add book! You have entered a number that exceed the stock.");
                                                window.location.href="homepage.php";
                                            </script>';
                                        } else if ($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                                            if (isset($_SESSION['shopping_cart'][$id])) {
                                                echo
                                                '<script>
                                                    alert("Failed to add book! Book is already exist in the shopping cart.");
                                                    window.location.href="homepage.php";
                                                </script>';
                                            } else {
                                                $_SESSION['shopping_cart'][$id] = $quantity;

                                                echo
                                                '<script>
                                                    alert("Book is added to the shopping cart successfully.");
                                                    window.location.href="homepage.php";
                                                </script>';
                                            }
                                        } else if ($row['BookID'] == $id && $row['StockQuantity'] == 0) {
                                            echo
                                            '<script>
                                                alert("Failed to add book! The book is out of stock.");
                                                window.location.href="homepage.php";
                                            </script>';
                                        }
                                    }
                                    ?>
                                </form>
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
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>

    <!-- Slider -->
    <script type="text/javascript" src="js/bxslider.min.js"></script>
    <script type="text/javascript" src="js/script.slider.js"></script>
</body>

</html>