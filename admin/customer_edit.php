<!DOCTYPE html>
<html>

<head>
    <title>Member- Edit Customer User</title>

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
                <small>customers</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="customer_view.php"><i class="active">Customer</i></a></li>
                <li><a href=""><i class="active">Edit Customer</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Edit Customer User</h3>
                        </div>

                        <?php 
                        $id = intval($_GET['id']);
                        $query = mysqli_query($connection, "SELECT * FROM customer WHERE CustomerID=$id");
                        while ($row = mysqli_fetch_array($query))
                            {
                            ?>
                        <form role="form" action="php_action/customer/edit_customer.php" method="post"
                            enctype="multipart/form-data" onSubmit="return validate_edit_customer();">
                            <input type="hidden" name="customerid" value="<?php echo $row['CustomerID'] ?>">

                            <div class="box-body">

                                <div class="form-group col-md-6"">
                                        <label for=" firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="first_name"
                                        value="<?php echo $row['FirstName'] ?>" placeholder="First Name"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6" ">
                                        <label for=" lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="last_name"
                                        value="<?php echo $row['LastName'] ?>" placeholder="Last Name"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                        value="<?php echo $row['Email'] ?>" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="contact_number"
                                        placeholder="Phone" value="<?php echo $row['ContactNumber'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Street Address</label>
                                    <input type="text" class="form-control" id=address" name="street_address"
                                        placeholder="Street Address" value="<?php echo $row['StreetAddress'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                        value="<?php echo $row['City'] ?>" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State"
                                        value="<?php echo $row['State'] ?>" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="zipcode">ZipCode</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                                        placeholder="zipcode" value="<?php echo $row['ZipCode'] ?>" autocomplete="off"
                                        required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Current Password</label>
                                    <div class="input-group" id="show_hide_password1">
                                        <input readonly class="form-control" type="password" id="cpassword"
                                            name="current_password" value="<?php echo $row['Password'] ?>"></input>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group col-md-6">
                                    <label>New Password</label>
                                    <div class="input-group" id="show_hide_password2">
                                        <input class="form-control" type="password" id="npassword"
                                            name="new_password"></input>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Confirm New Password</label>
                                    <div class="input-group" id="show_hide_password2">
                                        <input class="form-control" type="password" id="cnpassword"
                                            name="confirm_new_password"></input>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="account status">Account Activation Status</label>
                                    <select class="form-control" name=account_status>
                                        <option value="Enabled" <?php 
                                        if ($row["AccountStatus"]=="Enabled") {
                                        ?> selected="selected" <?php
                                            } 
                                        ?>>Enabled</option>
                                        <option value="Disabled" <?php 
                                        if ($row["AccountStatus"]=="Disabled") {
                                        ?> selected="selected" <?php
                                            } 
                                        ?>>Disabled</option>
                                    </select>
                                </div>
                                <!-- /.box-body -->
                                <?php
                                }
                                
                                ?>

                                <div class="box-footer col-md-12" style="margin: 0px 0px 0px 5px">
                                    <button type="submit" class="btn btn-primary" name="update_customer_btn">Save
                                        Changes</button>
                                    <a href="customer_view.php" class="btn btn-warning">Back</a>
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