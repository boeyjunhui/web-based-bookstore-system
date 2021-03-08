<?php

include "../../assets/plugins/TCPDF-main/tcpdf.php";

$connection = mysqli_connect("localhost", "root", "", "book_republic");

if (!$connection) {
    echo "There is error connecting to the database." . mysqli_error($connection);
}

if (isset($_POST)) {
    

    class PDF extends TCPDF
    {
        public function header()
        {
            // Ln(line number);
            // SetFont(font style, font type, font size)
            // Cell(width, height, text, border, line, align)
            $this->Ln(6);
            $this->SetFont('Helvetica', 'B', 20);
            $this->Cell(180, 0, 'Book Republic Sdn Bhd', 0, 1, 'C');
            $this->SetFont('Times', '', 12);
            $this->Cell(180, 10, '22, Jalan Hang Tuah 3, Salak South Garden, 57100 Kuala Lumpur,', 0, 1, 'C');
            $this->Cell(180, 8, 'Wilayah Persekutuan Kuala Lumpur.', 0, 1, 'C');
            $this->Cell(180, 8, 'Phone: +603 3355 2520', 0, 1, 'C');
            $this->Cell(180, 8, 'Email: bookrepublic@gmail.com', 0, 1, 'C');
            $this->SetFont('Helvetica', 'B', 18);
            $this->Cell(180, 8, 'Book Stock Report', 0, 1, 'C');
            $this->SetFont('Times', 'B', 14);
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $today = date("j F Y", time());
            $this->Cell(180, 20, 'Report as on: ' . $today, 0, 1, 'C');
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
            $this->Cell(200, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 
            0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Book Republic Sdn Bhd - Book Stock Report');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), 
    array(0, 64, 128));
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
    $pdf->Cell(180, 5, 'Book Stock', 0, 1, 'C');
    $pdf->Ln(1);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(20, 8, 'Book ID', 1, 0, 'C');
    $pdf->Cell(70, 8, 'Book Title', 1, 0, 'C');
    $pdf->Cell(20, 8, 'Quantity', 1, 0, 'C');
    $pdf->Cell(30, 8, 'Category', 1, 0, 'C');
    $pdf->Cell(40, 8, 'ISBN 13', 1, 0, 'C');

    $query = "SELECT * FROM book";
    $query_run = mysqli_query($connection, $query);

    $i = 1;
    $max = 16;

    while ($row = mysqli_fetch_array($query_run)) {
        $book_id = $row['BookID'];
        $book_title = $row['Title'];
        $quantity = $row['StockQuantity'];
        $category = $row['Category'];
        $ISBN13 = $row['ISBN13'];

        if (($i % $max) == 0) {
            $pdf->AddPage();

            $pdf->Ln(55);

            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(180, 5, 'Book Stock', 0, 1, 'C');
            $pdf->Ln(1);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(20, 8, 'Book ID', 1, 0, 'C');
            $pdf->Cell(70, 8, 'Book Title', 1, 0, 'C');
            $pdf->Cell(20, 8, 'Quantity', 1, 0, 'C');
            $pdf->Cell(30, 8, 'Category', 1, 0, 'C');
            $pdf->Cell(40, 8, 'ISBN 13', 1, 0, 'C');
        }

        $pdf->Ln(8);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(20, 8, $book_id, 1, 0, 'C');
        $pdf->Cell(70, 8, $book_title, 1, 0, 'C');
        $pdf->Cell(20, 8, $quantity, 1, 0, 'C');
        $pdf->Cell(30, 8, $category, 1, 0, 'C');
        $pdf->Cell(40, 8, $ISBN13, 1, 0, 'C');
        $i++;
    }
    mysqli_close($connection);
}

// Close and output PDF document
$pdf->Output('Book_Republic_Book_Stock_Report.pdf', 'I');

?>