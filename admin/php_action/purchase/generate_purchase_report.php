<?php

include "../../assets/plugins/TCPDF-main/tcpdf.php";

$connection = mysqli_connect("localhost", "root", "", "book_republic");

if (!$connection) {
    echo "There is error connecting to the database." . mysqli_error($connection);
}

if (isset($_POST)) {
    
    $startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	
	$query = "SELECT * FROM stock_purchase
	INNER JOIN book ON stock_purchase.BookID = book.BookID
    INNER JOIN supplier ON stock_purchase.SupplierID = supplier.SupplierID
	WHERE DateAdded >= '$startDate' AND DateAdded <= '$endDate'";
	$query_run = mysqli_query($connection, $query);

    class PDF extends TCPDF
    {
        public function header()
        {
            // Ln(line number);
            // SetFont(font style, font type, font size)
            // Cell(width, height, text, border, line, align)
            $startDate = $_POST['startDate'];
	        $endDate = $_POST['endDate'];
            $this->Ln(9);
            $this->SetFont('Helvetica', 'B', 20);
            $this->Cell(180, 0, 'Book Republic Sdn Bhd', 0, 1, 'C');
            $this->SetFont('Times', '', 12);
            $this->Cell(180, 10, '22, Jalan Hang Tuah 3, Salak South Garden, 57100 Wilayah Persekutuan Kuala Lumpur,', 0, 1, 'C');
            $this->Cell(180, 8, 'Phone: +603 3355 2520', 0, 1, 'C');
            $this->Cell(180, 8, 'Email: bookrepublic@gmail.com', 0, 1, 'C');
            $this->SetFont('Helvetica', 'B', 18);
            $this->Cell(180, 8, 'Stock Purchase Record Report', 0, 1, 'C');
            $this->SetFont('Times', 'B', 14);
            $this->Cell(180, 10, 'Report as from: ' .$startDate, 0, 1, 'C');
            $this->Cell(180, 10, 'Report as until: ' .$endDate, 0, 1, 'C');
        
        }

        public function footer()
        {
            // Ln(line number);
            // SetFont(font style, font type, font size)
            // Cell(width, height, text, border, line, align)
            $this->SetY(-50);
            $this->Ln(2);
            $this->SetFont('Times', 'B', 12);
            $this->Cell(20, 25, 'Signature:', 0, 1, 'L');
            $this->Cell(20, 10, '____________________', 0, 1, 'L');
            $this->Cell(200, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Book Republic Sdn Bhd - Stock Purchase Report');
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

    $pdf->Ln(55);

    $pdf->SetFont('Times', 'B', 14);
    $pdf->Cell(180, 5, 'Stock Purchase Record', 0, 1, 'C');
    $pdf->Ln(1);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(10, 8, 'ID', 1, 0, 'C');
    $pdf->Cell(50, 8, 'Book Title', 1, 0, 'C');
    $pdf->Cell(50, 8, 'Supplier', 1, 0, 'C');
    $pdf->Cell(30, 8, 'Date', 1, 0, 'C');
    $pdf->Cell(10, 8, 'Qty', 1, 0, 'C');
    $pdf->Cell(30, 8, 'Sub Total (RM)', 1, 0, 'C');
    

    

    $i = 1;
    $max = 16;
    $grand_total = 0.00;    
    while ($row = mysqli_fetch_array($query_run)) {
        $purchase_id = $row['PurchaseID'];
        $supplier_name = $row['SupplierName'];
        $book_title = $row['Title'];
        $date_added = $row['DateAdded'];
        $quantity = $row['Quantity'];
        $sub_total = $row['GrandTotal'];
        $grand_total += $sub_total ;
        


        if (($i % $max) == 0) {
            $pdf->AddPage();

            $pdf->Ln(55);

            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(180, 5, 'Stock Purchase Record', 0, 1, 'C');
            $pdf->Ln(1);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(10, 8, 'ID', 1, 0, 'C');
            $pdf->Cell(50, 8, 'Book Title', 1, 0, 'C');
            $pdf->Cell(50, 8, 'Supplier', 1, 0, 'C');
            $pdf->Cell(30, 8, 'Date', 1, 0, 'C');
            $pdf->Cell(10, 8, 'Qty', 1, 0, 'C');
            $pdf->Cell(30, 8, 'Sub Total (RM)', 1, 0, 'C');
            
            
        }

        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(10, 8, $purchase_id, 1, 0, 'C');
        $pdf->Cell(50, 8, $book_title, 1, 0, 'C');
        $pdf->Cell(50, 8, $supplier_name, 1, 0, 'C');
        $pdf->Cell(30, 8, $date_added, 1, 0, 'C');
        $pdf->Cell(10, 8, $quantity, 1, 0, 'C');
        $pdf->Cell(30, 8, $sub_total, 1, 0, 'C');
        
        $i++;
        
    }
    
    $pdf->Ln(8);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(150, 8, 'Grand Total (RM)', 1, 0, 'C');
    $pdf->Cell(30, 8, $grand_total, 1, 0, 'C');
    mysqli_close($connection);
    
}

// Close and output PDF document
$pdf->Output('Book_Republic_Order_Sale_Report.pdf', 'I');

?>