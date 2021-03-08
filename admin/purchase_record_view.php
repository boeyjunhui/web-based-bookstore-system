<!DOCTYPE html>
<html>

<head>
    <title>Admin - Stock Purchase Record</title>
</head>
<?php 
include('php_action/security.php');
include('php_action/db_connect.php');
include('templates/header.php');
include('templates/header_menu.php'); 
include('templates/side_menubar.php'); 
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>stock purchase</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="purchase_view.php"><i class="active">Purchase Record</i></a></li>
                <li><a href=""><i class="active">View Stock Purchase</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Stock Purchase Info</h3>
                        </div>

                        <?php 
                        $id = intval($_GET['id']);
                        $query ="SELECT * FROM stock_purchase
                        INNER JOIN book ON stock_purchase.BookID = book.BookID
                        INNER JOIN supplier ON stock_purchase.SupplierID = supplier.SupplierID
                        where stock_purchase.PurchaseID='$id'";
                        $query_run = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_array($query_run))
                            {
                            ?>
                        <form role="form" action="" method="post">
                            <input type="hidden" name="purchase_id" value="<?php echo $row['PurchaseID'] ?>">
                            <div class="box-body">

                                <div class="form-group col-md-6"">
                                        <label for=" username">Purchase Number</label>
                                    <input readonly type="text" class="form-control" id="purchasenumber" name="purchase_number"
                                        value="<?php echo $row['PurchaseNumber'] ?>" placeholder="Purchase Number"
                                        autocomplete="off" required>
                                </div>
                            
                                <div class="form-group col-md-6"">
                                        <label for=" username">Book Title</label>
                                    <input readonly type="text" class="form-control" id="booktitle" name="book_title"
                                        value="<?php echo $row['Title'] ?>" placeholder="Book Title"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6"">
                                        <label for=" username">Supplier Name</label>
                                    <input readonly type="text" class="form-control" id="suppliername" name="supplier_name"
                                        value="<?php echo $row['SupplierName'] ?>" placeholder="Supplier"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6"">
                                        <label for=" username">Supplier Company Name</label>
                                    <input readonly type="text" class="form-control" id="companyname" name="company_name"
                                        value="<?php echo $row['CompanyName'] ?>" placeholder="Company"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="quantity">Quantity Ordered</label>
                                    <input readonly type="number" class="form-control" id="quantity" name="quantity" min="0"
                                        value="<?php echo $row['Quantity'] ?>" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="stock_price">Stock Book Price</label>
                                    <input readonly type="number" class="form-control twodecimalonly" id="stockprice"
                                        name="stock_price" min="0.00" value="<?php echo $row['StockPrice'] ?>" step="0.01" placeholder="Book Stock Price"
                                        autocomplete="off">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="total_amount">Grand Total (RM)</label>
                                    <input readonly type="number" class="form-control twodecimalonly" id="grandtotal"
                                        name="grand_total" min="0.00" value="<?php echo $row['GrandTotal'] ?>" step="0.01" placeholder="Grand Total"
                                        autocomplete="off">
                                </div>
                            </div>
                                <?php
                            }
                                ?>

                            <!-- /.box-body -->

                            <div class="box-footer col-md-12" style="margin: 0px 0px 0px 0px">
                                <a href="purchase_view.php" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- col-md-12 -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('templates/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".twodecimalonly").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
        $("#book_select").select2();
        $("#company_select").select2();
    });

    </script>