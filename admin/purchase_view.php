<!DOCTYPE html>
<html>

<head>
    <title>Admin - Purchase List</title>

<?php 
include('php_action/security.php');
include('php_action/db_connect.php');
include('templates/header.php');
include('templates/header_menu.php'); 
include('templates/side_menubar.php'); 
?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>stock purchases</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href=""><i class="active">Purchase Record</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <a href="purchase_create.php" class="btn btn-primary">Add Stock</a>
                    <a href="purchase_report_date.php" class="btn btn-primary pull pull-right">Generate Report</a>
                    </br></br>


                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Stock Purchase Table </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="bookTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>PurchaseID</th>
                                        <th>PurchaseNumber</th>
                                        <th>Title</th>
                                        <th>Supplier Name</th>
                                        <th>Quantity Added</th>
                                        <th>Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM stock_purchase
                                        INNER JOIN supplier ON stock_purchase.SupplierID = supplier.SupplierID
                                        INNER JOIN book ON stock_purchase.BookID = book.BookID";
                                        $result = mysqli_query($connection, $query);
                                    ?>
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                    echo '  
                                    <tr>  
                                            <td>'.$row["PurchaseID"].'</td>  
                                            <td>'.$row["PurchaseNumber"].'</td> 
                                            <td>'.$row["Title"].'</td> 
                                            <td>'.$row["SupplierName"].'</td>  
                                            <td>'.$row["Quantity"].'</td>  
                                            <td>'.$row["DateAdded"].'</td> 
                                            <td> <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="purchase_record_view.php?id='.$row['PurchaseID'].'"><i class="glyphicon glyphicon-edit"></i> View</a></li>   
                                            <li><a onclick="return confirm(\'Delete '.$row['PurchaseNumber'].' record?\')"href="php_action/purchase/delete_purchase.php?id='.$row['PurchaseID'].'"><i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
                                            </ul>
                                        </div>
                                        </td>
                                    </tr>  
                                    ';  
                                    }  
                                ?>
                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.box-body -->
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

    <?php require_once 'templates/footer.php'; ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#bookTable').DataTable({
        order: [[0, 'desc']]
        });

    });
    </script>