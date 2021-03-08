<!DOCTYPE html>
<html>

<head>
    <title>Admin - Rating List</title>

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
                <small>rating</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href=""><i class="active">Rating</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Rating Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="contactTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Rate ID</th>
                                        <th>Full Name</th>
                                        <th>Book Title</th>
                                        <th>Rate 1 - 5</th>
                                        <th>ISBN 13</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM rating
                                        INNER JOIN customer on rating.CustomerID = customer.CustomerID
                                        INNER JOIN book on rating.BookID = book.BookID";
                                        
                                        $result = mysqli_query($connection, $query);
                                    ?>
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                    echo '  
                                    <tr>    
                                            <td>'.$row["RateID"].'</td> 
                                            <td>'.$row["FirstName"].' '.$row["LastName"].'</td>  
                                            <td>'.$row["Title"].'</td>
                                            <td>'.$row["Rate"].'</td>
                                            <td>'.$row["ISBN13"].'</td>
                                            <td>'.$row["Date"].'</td>
                                            <td> <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a onclick="return confirm(\'Delete '.$row["FirstName"].' '.$row["LastName"].' rating?\')"href="php_action/rating/delete_rating.php?id='.$row['RateID'].'"><i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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
        $('#contactTable').DataTable({
        order: [[0, 'desc']]
        });

    });
    </script>