<?php

include "../../assets/plugins/TCPDF-main/tcpdf.php";

$connection = mysqli_connect("localhost", "root", "", "book_republic");

if (!$connection) {
    echo "There is error connecting to the database." . mysqli_error($connection);
}

if (isset($_POST)) {

    $order_id = intval($_GET ['id']);

    class PDF extends TCPDF
    {
        public function header()
        {
            // Ln(line number);
            // SetFont(font style, font type, font size)
            // Cell(width, height, text, border, line, align)
            $this->Ln(6);
            $imageFile = K_PATH_IMAGES . 'book_republic_logo.png';
            $this->Image($imageFile, 75, 5, 60, 15, 'PNG', '', 'T', false, '300', '', false, false, 0, false, false, false, 'Book Republic Logo', false);
            $this->SetFont('Times', 'B', 18);
            $this->Cell(180, 15, '', 0, 1, 'C');
            $this->Cell(180, 10, 'Order Receipt', 0, 1, 'C');
            $this->SetFont('Times', '', 12);
            $this->Cell(180, 8, 'Dear Book Republic customer,', 0, 1, 'C');
            $this->Cell(180, 8, 'we\'ve received, reviewed, and confirmed your order.', 0, 1, 'C');
            $this->Cell(180, 8, 'Thank you for shopping from us!', 0, 1, 'C');
        }

        public function footer()
        {
            $this->Cell(200, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Book Republic Sdn Bhd - Customer Order Receipt');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Add a page
    // Ln(line number);
    // SetFont(font style, font type, font size)
    // Cell(width, height, text, border, line, align)

    $pdf->AddPage();

    $pdf->Ln(35);

    // First
    $query = "SELECT * FROM customer
        INNER JOIN new_order ON customer.CustomerID = new_order.CustomerID
        INNER JOIN order_item ON new_order.OrderID = order_item.OrderID
        INNER JOIN book ON order_item.BookID = book.BookID
        WHERE new_order.OrderID = '$order_id'
        LIMIT 1";
    $query_run = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($query_run)) {
        $customer_name = $row['FirstName'] . ' ' . $row['LastName'];
        $order_number = $row['OrderNumber'];
        $date = $row['Date'];
        $time = $row['Time'];

        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(20, 8, 'Customer Name', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(20, 5, $customer_name, 0, 1, '');

        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(20, 8, 'Order Number', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(20, 5, $order_number, 0, 1, '');

        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(20, 8, 'Date', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(20, 5, $date, 0, 1, '');

        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(20, 8, 'Time', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(20, 5, $time, 0, 1, '');
    }

    // Second
    $pdf->Ln(5);
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(180, 5, 'Ordered Item(s)', 0, 1, 'C');

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Ln(2);
    $pdf->Cell(85, 8, 'Book Title', 1, 0, 'C');
    $pdf->Cell(25, 8, 'Quantity', 1, 0, 'C');
    $pdf->Cell(35, 8, 'Price', 1, 0, 'C');
    $pdf->Cell(35, 8, 'Subtotal', 1, 0, 'C');

    $query = "SELECT * FROM customer
        INNER JOIN new_order ON customer.CustomerID = new_order.CustomerID
        INNER JOIN order_item ON new_order.OrderID = order_item.OrderID
        INNER JOIN book ON order_item.BookID = book.BookID
        WHERE new_order.OrderID = '$order_id'";
    $query_run = mysqli_query($connection, $query);

    $i = 1;
    $max = 11;

    while ($row = mysqli_fetch_assoc($query_run)) {
        $book_title = $row['Title'];
        $quantity = $row['Quantity'];
        $book_price = $row['SalePrice'];
        $subtotal = $row['Quantity'] * $row['SalePrice'];

        if (($i % $max) == 0) {
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(180, 5, 'Ordered Item(s)', 0, 1, 'C');
            $pdf->Ln(1);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(85, 8, 'Book Title', 1, 0, 'C');
            $pdf->Cell(25, 8, 'Quantity', 1, 0, 'C');
            $pdf->Cell(35, 8, 'Price', 1, 0, 'C');
            $pdf->Cell(35, 8, 'Subtotal', 1, 0, 'C');
        }

        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(85, 8, $book_title, 1, 0, 'C');
        $pdf->Cell(25, 8, $quantity, 1, 0, 'C');
        $pdf->Cell(35, 8, 'RM ' . number_format($book_price, 2), 1, 0, 'C');
        $pdf->Cell(35, 8, 'RM ' . number_format($subtotal, 2), 1, 0, 'C');
        $i++;
    }

    // Third
    $query = "SELECT * FROM customer
        INNER JOIN new_order ON customer.CustomerID = new_order.CustomerID
        INNER JOIN order_item ON new_order.OrderID = order_item.OrderID
        INNER JOIN book ON order_item.BookID = book.BookID
        WHERE new_order.OrderID = '$order_id'
        LIMIT 1";
    $query_run = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($query_run)) {
        $grand_total = $row['GrandTotal'];
        $payment_method = $row['PaymentMethod'];
        $billing_address = $row['StreetAddress'] . ' ' . $row['ZipCode'] . ' '  . $row['City'] . ' ' . $row['State'];
        $delivery_address = $row['DeliveryAddress'];

        $pdf->Ln(15);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(50, 8, 'Grand Total', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(25, 5, 'RM ' . number_format($grand_total, 2), 0, 1, '');

        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(50, 8, 'Payment Method', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(25, 5, $payment_method, 0, 1, '');

        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(50, 8, 'Billing Address', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(25, 5, $billing_address, 0, 1, '');

        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Cell(50, 8, 'Delivery Address', 0, 1, '');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(25, 5, $delivery_address, 0, 1, '');
    }
    mysqli_close($connection);
}

// Close and output PDF document
$pdf->Output('Book_Republic_Customer_Order_Receipt.pdf', 'I');

?>