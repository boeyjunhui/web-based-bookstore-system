<!DOCTYPE html>
<html>

<head>
    <title>Admin - Customer List</title>

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
                <small>customers</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href=""><i class="active">Customer</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Customer Table</h3>
                        </div>
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="customerTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Customer ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM customer";
                                        $result = mysqli_query($connection, $query);
                                    ?>
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                    echo '  
                                    <tr>  
                                            <td>'.$row["CustomerID"].'</td>  
                                            <td>'.$row["FirstName"].'</td>  
                                            <td>'.$row["LastName"].'</td>  
                                            <td>'.$row["Email"].'</td>  
                                            <td>'.$row["ContactNumber"].'</td>
                                            <td> <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="customer_edit.php?id='.$row['CustomerID'].'"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>   
                                            <li><a onclick="return confirm(\'Delete '.$row['FirstName'].' customer Profile?\')"href="php_action/customer/delete_customer.php?id='.$row['CustomerID'].'"><i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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
        $('#customerTable').DataTable({
        order: [[0, 'desc']]
        });

    });
    </script>