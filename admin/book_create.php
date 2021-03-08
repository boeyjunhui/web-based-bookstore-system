<!DOCTYPE html>
<html>

<head>
    <title>Admin - Add New Book</title>
    
    <?php 
    include('php_action/security.php');
    include('php_action/db_connect.php');
    include('templates/header.php');
    include('templates/header_menu.php');   
    include('templates/side_menubar.php'); 
    ?>
    <style>
    .btn-file {
        position: relative;
        overflow: hidden;

    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload {

        width: 200px;
        height: 250px;
        margin-bottom: 20px;
        background-image: url("https://dummyimage.com/200x250/ffffff/000000&text=Book+Republics");
    }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>books</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="book_view.php"><i class="active">Book</i></a></li>
                <li><a href=""><i class="active">Create Book</i></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add New Book</h3>
                        </div>

                        <form role="form" action="php_action/book/add_book.php" method="post" enctype="multipart/form-data" onSubmit="return validate_add_book();">
                        
                            <div class="box-body">
                                <div class="form-group col-md-6">
                                    <label for="productimage">New Image</label>
                                    <div class=" form-group ">
                                        <img id='img-upload' />
                                        <div class="input-group col-md-6">
                                            <span class="input-group-btn">
                                                <span class="btn btn-primary btn-file">
                                                    Browse… <input type="file" name="book_image" accept="image/*" id="imgInput" required>
                                                </span>
                                            </span>
                                            <input type="text" class="form-control" readonly>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="title">Book Title</label>
                                    <input type="text" class="form-control" id="booktitle" name="book_title"
                                        placeholder="Book Name" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        placeholder="Author Name" autocomplete="off" required>
                                </div>
                
                                <div class="form-group col-md-6">
                                    <label for="ISBN">ISBN-13</label>
                                    <input type="text" class="form-control" id="isbn13" name="isbn13"
                                        placeholder="ISBN 13" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="format">Format</label>
                                    <input type="text" class="form-control" id="format" name="format"
                                        placeholder="Format with number pages" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dimension">Dimension</label>
                                    <input type="text" class="form-control" id="dimension" name="dimension"
                                        placeholder="length x width x height (mm)" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="weight">Weight</label>
                                    <input type="text" class="form-control" id="weight" name="weight"
                                        placeholder="Weight (g)" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="publisher">Publisher</label>
                                    <input type="text" class="form-control" id="publisher" name="publisher"
                                        placeholder="Publisher Name" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="book_category" required>
                                        <option selected value="">Book Category...</option>
                                        <option value="Comic">Comic</option>

                                        <option value="Fiction">Fiction</option>

                                        <option value="Graphic Novel">Graphic Novel</option>

                                        <option value="Reference">Reference</option>

                                        <option value="Technology">Technology</option>
                                    </select>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="publicationdate">Publication Date</label>
                                    <input type="date" class="form-control" id="publicationdate" name="publication_date"
                                        placeholder="Publication Date" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="quantity">Stock Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" min="0" value="0" 
                                    placeholder="Book Quantity">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="saleprice">Sale Price (RM)</label>
                                    <input type="number" class="form-control twodecimalonly" id="saleprice" name="sale_price" min="0.00"
                                    value="0.00" step="0.01" placeholder="Stock Price" autocomplete="off" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="rate">Rating</label>
                                    <input type="number" class="form-control twodecimalonly" id="rating" name="rating" min="0" max="5"
                                    value="5" placeholder="Rate 1 to 5" autocomplete="off" required>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <div class="input-group">
                                    <textarea class="form-control" style="resize: none;" rows="10"
                                            cols="400" name="book_description" type="text" required></textarea>
                                    </div>
                                </div>

                                <!-- /.box-body -->

                                <div class="box-footer col-md-12" style="margin: 0px 0px 0px 0px">
                                    <button type="submit" class="btn btn-primary" name="add_book_btn">Save 
                                    </button>
                                    <a href="book_view.php" class="btn btn-warning">Back</a>
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
    <?php require_once 'templates/footer.php'; ?>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $("#groups").select2();
        $(".twodecimalonly").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(3));
        });

    });


    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInput").change(function() {
        readURL(this);
    });
    </script>