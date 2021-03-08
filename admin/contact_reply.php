<!DOCTYPE html>
<html>

<head>
    <title>Admin - View Customer Reply</title>

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
                <small>customer contacts</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="contact_view.php"><i class="active">Contact</i></a></li>
                <li><a href=""><i class="active">Customer Contact Info</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">View Customer Contact Info</h3>
                        </div>

                        <?php 
                        
                        $id = intval($_GET['id']);
                        
                        $query = mysqli_query($connection, "SELECT * FROM contact WHERE ContactID=$id");
                        $updatequery = "UPDATE contact SET Status='Seen' WHERE ContactID='$id'";
                        $query_run = mysqli_query($connection, $updatequery);
                        while ($row = mysqli_fetch_array($query))
                            {
                            ?>
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="memberid" value="<?php echo $row['ContactID'] ?>">

                            <div class="box-body">

                                <div class="form-group col-md-6"">
                                        <label for="fullname">Full Name</label>
                                    <input readonly type="text" class="form-control" id="fullname" name="full_name"
                                        value="<?php echo $row['FullName'] ?>" placeholder="First Name"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input readonly type="email" class="form-control" id="email" name="email"
                                        placeholder="Email" value="<?php echo $row['Email'] ?>" autocomplete="off"
                                        required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input readonly type="text" class="form-control" id="phone" name="contact_number"
                                        placeholder="Phone" value="<?php echo $row['ContactNumber'] ?>"
                                        autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="reason">Reason</label>
                                    <input readonly type="text" class="form-control" id="reason" name="reason"
                                        placeholder="Reason" value="<?php echo $row['Reason'] ?>" autocomplete="off"
                                        required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="message">Message</label>
                                    <div class="input-group">
                                        <textarea readonly class="form-control" style="resize: none;" rows="10"
                                            cols="400" name="message" type="text"
                                            required><?php echo $row['Message'] ?></textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->


                                <div class="box-footer col-md-12" style="margin: 0px 0px 0px 5px">
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row['Email'] ?>
                                    &cc=bookrepublic6@gmail.com&su=<?php echo $row['Reason'] ?>
                                    &body=Your Message: %0a<?php echo $row['Message'] ?>" target="_blank"
                                    class="btn btn-primary" name="reply_in_email_btn">Reply in email</a>
                                    
                                    <a href="contact_view.php" class="btn btn-warning">Back</a>
                                </div>

                                <?php
                                }
                                
                                ?>
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