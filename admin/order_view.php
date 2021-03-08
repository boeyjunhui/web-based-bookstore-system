<!DOCTYPE html>
<html>

<head>
    <title>Admin - Order List</title>

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
                <small>orders</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href=""><i class="active">Order</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <a href="order_report_date.php" class="btn btn-primary">Generate Report</a>

                    </br></br>

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Order Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="orderTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <td style="font-weight: bold; vertical-align:middle">OrderID</td>
                                        <td style="font-weight: bold; vertical-align:middle">Order Number</td>
                                        <td style="font-weight: bold; vertical-align:middle">Name</td>
                                        <td style="font-weight: bold; vertical-align:middle">Date & Time</td>
                                        <td style="font-weight: bold; vertical-align:middle">Grand Total</td>
                                        <td style="font-weight: bold; vertical-align:middle">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM new_order
                                        INNER JOIN customer ON new_order.CustomerID = customer.CustomerID";
                                        
                                        $result = mysqli_query($connection, $query);
                                    ?>
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                    echo '  
                                    <tr>    
                                            <td>'.$row["Status"].'</td> 
                                            <td>'.$row["OrderID"].'</td>  
                                            <td>'.$row["OrderNumber"].'</td> 
                                            <td>'.$row["FirstName"].' '.$row["LastName"].'</td>
                                            <td>'.$row["Date"].'/ '.$row["Time"].'</td>
                                            <td>RM '.$row["GrandTotal"].'</td>
                                            <td> <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="order_edit.php?id='.$row['OrderID'].'"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                            <li><a type="button" href="php_action/order/order_receipt.php?id='.$row['OrderID'].'"> <i class="glyphicon glyphicon-print"></i> Print </a></li>
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
        $('#orderTable').DataTable();
        $('#orderTable').ddTableFilter();

    });
    </script>