<!DOCTYPE html>
<html>

<head>
    <title>Order- Edit Order Details</title>

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
                <small>orders</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="order_view.php"><i class="active">Order</i></a></li>
                <li><a href=""><i class="active">Edit Order</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Edit Order</h3>
                        </div>

                        <?php 
                        $id = intval($_GET['id']);
        
                        $query ="SELECT * FROM new_order
                        INNER JOIN customer ON new_order.CustomerID = customer.CustomerID
                        where new_order.OrderID='$id'";

                        $query_run = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_array($query_run))
                        {
                        ?>

                        <form role="form" action="php_action/order/edit_order.php" method="post" enctype="multipart/form-data" onSubmit ="return validate_edit_order();" >
                            <input type="hidden" name="orderid" value="<?php echo $row['OrderID'] ?>">

                            <div class="box-body">
                                <div class="form-group col-md-4">
                                    <label for="ordernumber">Order Number</label>
                                    <input readonly type="text" class="form-control" id="ordernumber" name="order_number"
                                        value="<?php echo $row['OrderNumber'] ?>" placeholder="Order Number"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="date">Date Added</label>
                                    <input readonly type="date" class="form-control" name="date_added"
                                        value="<?php echo $row['Date'] ?>" placeholder="dd.mm.yyyy" autocomplete="off"
                                        required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="time">Time</label>
                                    <input readonly type="time" class="form-control" name="time_added"
                                        value="<?php echo $row['Time'] ?>" placeholder="" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="firstname">First Name</label>
                                    <input readonly type="text" class="form-control" id="firstname" name="first_name"
                                        placeholder="First Name" value="<?php echo $row['FirstName'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="lastname">Last Name</label>
                                    <input readonly type="text" class="form-control" id="lastname" name="last_name"
                                        placeholder="Last Name" value="<?php echo $row['LastName'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="paymentmethod">Payment Method</label>
                                    <input type="text" class="form-control" id="paymentmethod" name="payment_method"
                                        placeholder="Payment Method" value="<?php echo $row['PaymentMethod'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bank">Bank Type</label>
                                    <input type="text" class="form-control" id="bank" name="bank" placeholder="Bank"
                                        value="<?php echo $row['BankType'] ?>" autocomplete="off">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="bankreferencenumber">Bank Reference No.</label>
                                    <input type="text" class="form-control" id="bankreferenceno." name="bank_reference_no"
                                        placeholder="Bank Reference Number"
                                        value="<?php echo $row['ReferenceNumber'] ?>" autocomplete="off">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="deliveryaddress">Delivery Address</label>
                                    <input type="text" class="form-control" id="deliveryaddress" name="delivery_address"
                                        placeholder="Delivery Address" value="<?php echo $row['DeliveryAddress'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="courier">Courier Type</label>
                                    <input type="text" class="form-control" id="courier" name="courier"
                                        placeholder="Courier" value="<?php echo $row['CourierType'] ?>"
                                        autocomplete="off">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="courier">Tracking Number</label>
                                    <input type="text" class="form-control" id="trackingnumber" name="tracking_number"
                                        placeholder="Tracking Number" value="<?php echo $row['TrackingNumber'] ?>"
                                        autocomplete="off">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="status">Order Status</label>
                                    <select class="form-control" name=status>
                                        <option selected>Order Status...</option>
                                        <option value="Awaiting Payment" <?php 
                                        if ($row["Status"]=="Awaiting Payment") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Awaiting Payment</option>

                                        <option value="Awaiting Fulfillment" <?php 
                                        if ($row["Status"]=="Awaiting Fulfillment") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Awaiting Fulfillment</option>

                                        <option value="Awaiting Shipment" <?php 
                                        if ($row["Status"]=="Awaiting Shipment") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Awaiting Shipment</option>

                                        <option value="Awaiting Pickup" <?php 
                                        if ($row["Status"]=="Awaiting Pickup") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Awaiting Pickup</option>

                                        <option value="Completed" <?php 
                                        if ($row["Status"]=="Completed") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Completed</option>

                                        <option value="Shipped" <?php 
                                        if ($row["Status"]=="Shipped") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Shipped</option>

                                        <option value="Cancelled" <?php 
                                        if ($row["Status"]=="Cancelled") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Cancelled</option>

                                        <option value="Declined" <?php 
                                        if ($row["Status"]=="Declined") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Declined</option>

                                        <option value="Refunded" <?php 
                                        if ($row["Status"]=="Refunded") {
                                    ?> selected="selected" <?php
                                        } 
                                    ?>>Refunded</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Message">Message</label>
                                    <div class="input-group">
                                        <textarea class="form-control" style="resize: none;" rows="3" cols="500" name="message" 
                                        type="text"><?php echo $row['Message'] ?></textarea>
                                        
                                    </div>
                                </div>

                                <?php
                                }
                                
                                ?>

                                </br></br>

                                <table class="table table-bordered" id="product_info_table">
                                    <thead>
                                        <tr>
                                            <th style="width:50%">Product</th>
                                            <th style="width:10%">Quantity</th>
                                            <th style="width:10%">Subtotal</th>

                                    </thead>

                                    <tbody>
                                    <?php
                                    $id = intval($_GET['id']);
                                    $query1 = "SELECT * FROM order_item
                                    INNER JOIN book ON order_item.bookID = book.BookID
                                    INNER JOIN new_order ON order_item.OrderID = new_order.OrderID
                                    WHERE order_item.OrderID='$id'";

                                    $query_run1 = mysqli_query($connection,$query1);

                                    while ($row = mysqli_fetch_assoc($query_run1)) {

                                    ?>
                                        <td>
                                            <input type="text" name="title" id="title" autocomplete="off"
                                                disabled="true" class="form-control"
                                                value="<?php echo $row['Title']; ?>" />
                                        </td>

                                        <td>
                                            <input type="text" name="quantity" id="quantity" autocomplete="off"
                                                disabled="true" class="form-control"
                                                value="<?php echo $row['Quantity']; ?>" />
                                        </td>

                                        <td>
                                            <input type="text" name="subtotal" id="subtotal" autocomplete="off"
                                                disabled="true" class="form-control"
                                                value="<?php echo "RM ".number_format($row['Quantity']  * $row['SalePrice'],2); ?>" />
                                        </td>


                                    </tbody>
                                    <?php

                                        }

                                    ?>

                                </table>
                            </div>
                           
                            <?php 
                                $id = intval($_GET['id']);
                
                                $query2 ="SELECT * FROM new_order
                                where new_order.OrderID='$id'";

                                $query_run2 = mysqli_query($connection, $query2);
                                while ($row = mysqli_fetch_assoc($query_run2)) {
                                $updatequantitystatus = $row['QuantityReducedStatus'];
                                
                            ?>

                            <div class="col-md-6 col-xs-12 pull-right">

                                <div class="form-group row">
                                    <label style="padding: 4px 0px 0px 180px; margin: 0px 0px 0px 100px"
                                        for="grandtotal" class="col-sm-6 control-label">Grand Total: RM</label>

                                    <div class="col-sm-4 pull pull-right">
                                        <input style="margin: 0px 0px 0px 16px; width: 89%;" type="text"
                                            class="form-control" id="grandtotal" name="grand_total" disabled
                                            value="<?php echo "RM ".number_format($row['GrandTotal'],2); ?>" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            </br></br>

                            <div class="box-footer" style="margin: 0px 0px 0px 5px">
                                <button type="submit" class="btn btn-primary" name="update_order_btn">Save
                                    Changes</button>
                                <a href="order_view.php" class="btn btn-warning">Back</a>
                                <button type="submit" class="btn btn-dropbox pull-right" id="reducequantitybtn" 
                                name="update_stock_quantity_btn" <?php if($updatequantitystatus == 'True')  {echo "disabled=\"disabled\"";} ?>">Reduce Stock Quantity</button>
                                
                            </div>

                            <?php

                                }

                            ?>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
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
        $('.input-group.date').datepicker({
            format: "dd/mm/yyyy"
        });
    });

    </script>