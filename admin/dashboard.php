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
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <div class="row">
            <div style="height: 1000px;" class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div style="height: 130px;" class="inner">
                        <?php
                            $connection = mysqli_connect("localhost","root","","book_republic");
                            $query = "SELECT BookID FROM book ORDER BY BookID";
                            $query_run = mysqli_query($connection, $query);
                            $rows = mysqli_num_rows($query_run);

                            echo '<p style="font-size:32px; font-weight: bold;">'.$rows.'</p>';

                            mysqli_close($connection); 
                        ?>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                    <a href="book_view.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div style="height: 130px;" class="inner">
                        <?php
                            $connection = mysqli_connect("localhost","root","","book_republic");
                            $query = "SELECT OrderID FROM new_order WHERE Status = 'Completed' ORDER BY OrderID";
                            $query_run = mysqli_query($connection, $query);
                            $rows = mysqli_num_rows($query_run);

                            echo '<p style="font-size:32px; font-weight: bold;">'.$rows.'</p>';
                                    
                            mysqli_close($connection);   
                        ?>
                        <p>Total Paid Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money" aria-hidden="true"></i>
                    </div>
                    <a href="order_view.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div style="height: 130px;" class="inner">
                        <?php
                                $connection = mysqli_connect("localhost","root","","book_republic");
                                $query = "SELECT CustomerID FROM customer ORDER BY CustomerID";
                                $query_run = mysqli_query($connection, $query);
                                $rows = mysqli_num_rows($query_run);

                                echo '<p style="font-size:32px; font-weight: bold;">'.$rows.'</p>';
                                        
                                mysqli_close($connection);   
                            ?>

                        <p>Total Registered Customers</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="customer_view.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div style="height: 130px;" class="inner">
                        <?php
                                $connection = mysqli_connect("localhost","root","","book_republic");
                                $query = "SELECT PurchaseID FROM stock_purchase ORDER BY PurchaseID";
                                $query_run = mysqli_query($connection, $query);
                                $rows = mysqli_num_rows($query_run);

                                echo '<p style="font-size:32px; font-weight: bold;">'.$rows.'</p>';
                                        
                                mysqli_close($connection);   
                            ?>

                        <p>Total Stock Purchase Records</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                    </div>
                    <a href="purchase_view.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
$(document).ready(function() {
    $("#dashboardMainMenu").addClass('active');
});

setInterval(function(){
    check_logout();
}, 2000)


function check_logout(){
    jQuery.ajax({
        url :'php_action/security.php',
        data:'type=ajax',
        success:function(result){
            console.log(result);

        }

    });
}
</script>

<?php require_once 'templates/footer.php'; ?>