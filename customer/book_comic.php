<!DOCTYPE html>

<html lang="en">

<head>
    <title>Book - Comics</title>
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
    <!-- Book Category -->
    <div class="book-category">
        <div class="container">
            <div class="row">
                <h1 class="text-center mt-5 mb-5" style="color: white;">Comic</h1>
            </div>
        </div>
    </div>

    <!-- Book Catalog -->
    <div class="single-product-area">
        <div class="container">
            <div class="row">

                <?php
                $connection = mysqli_connect("localhost", "root", "", "book_republic");

                $query = "SELECT * FROM book WHERE Category = 'Comic'";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <form action="book_comic.php" method="POST" enctype="multipart/form-data">
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

                                <form action="book_comic.php" method="POST">
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
                                                window.location.href="book_comic.php";
                                            </script>';
                                        } else if ($quantity > 0 && filter_var($quantity, FILTER_VALIDATE_INT) && ($row['BookID'] == $id && $row['StockQuantity'] != 0)) {
                                            if (isset($_SESSION['shopping_cart'][$id])) {
                                                echo
                                                '<script>
                                                    alert("Failed to add book! Book is already exist in the shopping cart.");
                                                    window.location.href="book_comic.php";
                                                </script>';
                                            } else {
                                                $_SESSION['shopping_cart'][$id] = $quantity;

                                                echo
                                                '<script>
                                                    alert("Book is added to the shopping cart successfully.");
                                                    window.location.href="book_comic.php";
                                                </script>';
                                            }
                                        } else if ($row['BookID'] == $id && $row['StockQuantity'] == 0) {
                                            echo
                                            '<script>
                                                alert("Failed to add book! The book is out of stock.");
                                                window.location.href="book_comic.php";
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
</body>

</html>