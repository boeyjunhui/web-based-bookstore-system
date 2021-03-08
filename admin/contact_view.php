<!DOCTYPE html>
<html>

<head>
    <title>Admin - Message List</title>

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
                <small>contacts</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href=""><i class="active">Contact</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Customer Message Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="contactTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Contact ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM contact";
                                        
                                        $result = mysqli_query($connection, $query);
                                    ?>
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                    echo '  
                                    <tr>    
                                            <td>'.$row["ContactID"].'</td> 
                                            <td>'.$row["FullName"].'</td>  
                                            <td>'.$row["Email"].'</td>
                                            <td>'.$row["Reason"].'</td>
                                            <td>'.$row["Status"].'</td>
                                            <td> <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="contact_reply.php?id='.$row['ContactID'].'" name="update_message_status_btn"><i class="glyphicon glyphicon-edit"></i> View</a></li>
                                            <li><a onclick="return confirm(\'Delete '.$row['FullName'].' message?\')"href="php_action/contact/delete_contact.php?id='.$row['ContactID'].'"><i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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