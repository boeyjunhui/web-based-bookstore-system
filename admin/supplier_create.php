<!DOCTYPE html>
<html>

<head>
    <title>Admin - Add Supplier Profile</title>

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
                <small>suppliers</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="supplier_view.php"><i class="active">Supplier</i></a></li>
                <li><a href=""><i class="active">Add Supplier</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Supplier Profile</h3>
                        </div>
                        <form role="form" action="php_action/supplier/add_supplier.php" method="post" enctype="multipart/form-data" onSubmit ="return validate_add_supplier();">
                        
                            <div class="box-body">

                                <div class="form-group col-md-6"">
                                        <label for="supplier">Supplier Name</label>
                                    <input type="text" class="form-control" id="suppliername" name="supplier_name"
                                     placeholder="Supplier Name" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="company">Company Name</label>
                                    <input type="text" class="form-control" id="companyname" name="company_name"
                                        placeholder="Supplier Company Name" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="contact_number"
                                        placeholder="Phone" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Supplier Email" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address">Company Address</label>
                                    <div class="input-group">
                                        <textarea class="form-control" style="resize: none;" rows="10"
                                            cols="400" name="company_address" type="text" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Description">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" style="resize: none;" rows="30"
                                            cols="500" name="description" type="text" required></textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer col-md-12" style="margin: 0px 0px 0px 5px">
                                    <button type="submit" class="btn btn-primary" name="add_supplier_btn">Save 
                                    </button>
                                    <a href="supplier_view.php" class="btn btn-warning">Back</a>
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
    <script type="text/javascript">
    $(document).ready(function() {
        $("#groups").select2();

    });
    </script>