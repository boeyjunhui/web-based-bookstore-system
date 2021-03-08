<!DOCTYPE html>
<html>

<head>
    <title>Admin - Create Stock Purchase</title>

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
                <small>stock purchases</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="purchase_view.php"><i class="active">Purchase Record</i></a></li>
                <li><a href=""><i class="active">Create Stock Purchase</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add New Stock Purchase Record</h3>
                        </div>

                        <form role="form" action="php_action/purchase/add_purchase.php" method="post" enctype="multipart/form-data">
                            <div class="box-body">

                                <div class="form-group col-md-6">
                                    <label>Book Title</label>
                                    <select name="book_title" id="book_select" class="form-control" required>
                                        <option value="">Select Book</option>
                                        <?php
                                        $select_query = "SELECT * FROM book";
                                        $select_result = mysqli_query($connection, $select_query);
                                        while($select_data = mysqli_fetch_assoc($select_result))
                                        {
                                        ?>
                                        <option value="<?php echo $select_data['BookID']; ?>">
                                            <?php echo $select_data['Title']; ?>
                                        </option>
                                        }
                                        <?php

                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="supplier">Supplier Name</label>
                                    <select name="supplier" id="supplier_select" class="form-control" required>
                                        <option value="">Select Supplier : Company Name</option>
                                        <?php
                                        $select_query = "SELECT * FROM supplier";
                                        $select_result = mysqli_query($connection, $select_query);
                                        while($select_data = mysqli_fetch_assoc($select_result))
                                        {
                                        ?>
                                        <option value="<?php echo $select_data['SupplierID']; ?>">
                                            <?php echo $select_data['SupplierName']; ?> :
                                            <?php echo $select_data['CompanyName']; ?>
                                        </option>
                                        }
                                        <?php

                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="quantity">Quantity Ordered</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" min="0"
                                        value="0" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="stock_price">Stock Book Price</label>
                                    <input type="number" class="form-control twodecimalonly" id="stockprice"
                                        name="stock_price" min="0.00" value="0.00" step="0.01" placeholder="Grand Total"
                                        autocomplete="off">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grandtotal">Grand Total (RM)</label>
                                    <input readonly type="number" class="form-control twodecimalonly" id="grandtotal"
                                        name="grand_total" min="0.00" value="0.00" step="0.01" placeholder="Grand Total"
                                        autocomplete="off">
                                </div>

                
                                <!-- /.box-body -->

                                <div class="box-footer col-md-12" style="margin: 0px 0px 0px 0px">
                                    <button type="submit" class="btn btn-primary" name="add_purchase_btn">Save
                                    </button>
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
    <?php include('templates/footer.php');?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".twodecimalonly").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
        $("#book_select").select2();
        $("#supplier_select").select2();
    });

    $("#quantity").change(function() {

            calprice();
        }

    );

    $("#stockprice").change(function() {

            calprice();
        }

    );

    function calprice() {

        if ($("#quantity").val() == "0") {

            return false;
        } else if ($("#stockprice").val() == "0.00") {

            return false;
        } else {

            var total = 0.00;

            total = (Number($("#quantity").val()) * Number($("#stockprice").val()))

                    $("#grandtotal").val(total.toFixed(2));


                }
            }
    </script>