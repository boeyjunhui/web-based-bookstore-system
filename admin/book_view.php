<!DOCTYPE html>
<html>

<head>
    <title>Admin - Book List</title>

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
                <small>books</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href=""><i class="active">Book</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <a href="book_create.php" class="btn btn-primary">Add Book</a>
                    <a href="php_action/book/generate_book_report.php" class="btn btn-primary pull pull-right">Generate Report</a>
                    </br></br>


                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Book Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="bookTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>BookID</th>
                                        <th>Title</th>
                                        <th>ISBN 13</th>
                                        <th>Sales Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM book";
                                        $result = mysqli_query($connection, $query);
                                    ?>
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                    echo '  
                                    <tr>  
                                            <td>'.$row["BookID"].'</td>  
                                            <td>'.$row["Title"].'</td> 
                                            <td>'.$row["ISBN13"].'</td> 
                                            <td>RM '.$row["SalePrice"].'</td>  
                                            <td>'.$row["StockQuantity"].'</td>
                                            <td> <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="book_edit.php?id='.$row['BookID'].'"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>   
                                            <li><a onclick="return confirm(\'Delete '.$row['Title'].' book?\')"href="php_action/book/delete_book.php?id='.$row['BookID'].'"><i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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