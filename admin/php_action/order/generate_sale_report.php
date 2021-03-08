<?php

include "../../assets/plugins/TCPDF-main/tcpdf.php";

$connection = mysqli_connect("localhost", "root", "", "book_republic");

if (!$connection) {
    echo "There is error connecting to the database." . mysqli_error($connection);
}

if (isset($_POST)) {
    
    $startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	
	$query = "SELECT * FROM new_order
	INNER JOIN customer ON new_order.CustomerID = customer.CustomerID
	WHERE Date >= '$startDate' AND Date <= '$endDate' and Status = 'Completed'";
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
            $this->Cell(180, 8, 'Order Sale Report', 0, 1, 'C');
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
    $pdf->SetTitle('Book Republic Sdn Bhd - Order Sales Report');
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
    $pdf->Cell(180, 5, 'Order Sales', 0, 1, 'C');
    $pdf->Ln(1);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(20, 8, 'Order ID', 1, 0, 'C');
    $pdf->Cell(70, 8, 'Order Number', 1, 0, 'C');
    $pdf->Cell(50, 8, 'Date', 1, 0, 'C');
    $pdf->Cell(40, 8, 'Sub Total (RM)', 1, 0, 'C');
    

    

    $i = 1;
    $max = 16;
    $grand_total = 0.00;
    while ($row = mysqli_fetch_array($query_run)) {
        $order_id = $row['OrderID'];
        $order_number = $row['OrderNumber'];
        $date = $row['Date'];
        $sub_total = $row['GrandTotal'];
        $grand_total += $sub_total ;


        if (($i % $max) == 0) {
            $pdf->AddPage();

            $pdf->Ln(55);

            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(180, 5, 'Order Sales', 0, 1, 'C');
            $pdf->Ln(1);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(20, 8, 'Order ID', 1, 0, 'C');
            $pdf->Cell(70, 8, 'Order Number', 1, 0, 'C');
            $pdf->Cell(50, 8, 'Date', 1, 0, 'C');
            $pdf->Cell(40, 8, 'Sub Total (RM)', 1, 0, 'C');
            
            
        }

        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(20, 8, $order_id, 1, 0, 'C');
        $pdf->Cell(70, 8, $order_number, 1, 0, 'C');
        $pdf->Cell(50, 8, $date, 1, 0, 'C');
        $pdf->Cell(40, 8, $sub_total, 1, 0, 'C');
        
        $i++;
        
    }
    
    $pdf->Ln(8);
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(140, 8, 'Grand Total (RM)', 1, 0, 'C');
    $pdf->Cell(40, 8, $grand_total, 1, 0, 'C');
    mysqli_close($connection);
    
}

// Close and output PDF document
$pdf->Output('Book_Republic_Order_Sale_Report.pdf', 'I');

?>