<!DOCTYPE html>
<html>

<head>
    <title>Member- Edit Member User</title>

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
                <small>organization members</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="member_view.php"><i class="active">Member</i></a></li>
                <li><a href=""><i class="active">Edit Member</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Edit Member User</h3>
                        </div>
                        
                        <?php 
                        $id = intval($_GET['id']);
                        $query = mysqli_query($connection, "SELECT * FROM organization_member WHERE MemberID=$id");
                        while ($row = mysqli_fetch_array($query))
                            {
                            ?>
                        <form role="form" action="php_action/member/edit_member.php" method="post" enctype="multipart/form-data" onSubmit="return validate_edit_member();">
                            <input type="hidden" name="memberid" value="<?php echo $row['MemberID'] ?>">

                            <div class="box-body">

                                <div class="form-group col-md-6"">
                                        <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="first_name"value="<?php echo $row['FirstName'] ?>" 
                                    placeholder="First Name" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6" ">
                                        <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="last_name" value="<?php echo $row['LastName'] ?>" 
                                    placeholder="Last Name" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" 
                                    value="<?php echo $row['Email'] ?>" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="contact_number" placeholder="Phone"
                                        value="<?php echo $row['ContactNumber'] ?>" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Current Password</label>
                                    <div class="input-group" id="show_hide_password1">
                                        <input readonly class="form-control" type="password" id="cpassword" name="current_password" 
                                        value="<?php echo $row['Password'] ?>" required></input>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>New Password</label>
                                    <div class="input-group" id="show_hide_password2">
                                        <input class="form-control" type="password" id="npassword" name="new_password"></input>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Confirm New Password</label>
                                    <div class="input-group" id="show_hide_password2">
                                        <input class="form-control" type="password" id="cnpassword" name="confirm_new_password"></input>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <?php
                                }
                                
                                ?>
                                
                                <div class="box-footer col-md-12" style="margin: 0px 0px 0px 5px">
                                    <button type="submit" class="btn btn-primary" name="update_member_btn">Save
                                        Changes</button>
                                    <a href="member_view.php" class="btn btn-warning">Back</a>
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