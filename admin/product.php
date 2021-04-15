<?php
require_once 'assets/serverside/session_start.php';

$title = "Eche's - product";
require_once 'assets/serverside/funcs.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once 'assets/extracts/header-links.html';
    ?>

</head>

<body>

<!-- Navigation turned header -->
<?php
require_once 'assets/extracts/header.html';
?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <!--sidebar-->
        <?php
        require_once 'assets/extracts/side.html';
        ?>

        <div class="col-lg-10 cont radii animate__animated animate__slideInUp">
            <!-- content goes here-->
            <div class="card radii p-2">
                <h4 class="p-2">Products</h4>
                <h5 id="add-cat" class="p-2">
                    <span class="bfor">Add product</span>
                    <span class="after"><i class="fa fa-chevron-circle-left"></i> Back</span>
                </h5>
                <div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>CATEGORY</th>
                                <th>PRODUCTS</th>
                                <th>IMAGE</th>
                                <th>MRP</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th class="text-center">STATUS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="table">

                            </tbody>
                        </table>
                    </div>
                </div>

                <!--    add product form    -->
                <div class="form" id="form">
                    <form method="post" id="frmProduct">
                        <div class="form-group">
                            <label for="selectCat">Category:</label>
                            <select name="selectCat" class="form-control">
                                <option>select category</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT id, categories FROM categories");

                                while ($cats = mysqli_fetch_assoc($sql)){

                                    echo "<option value='". $cats['id'] ."'>". $cats['categories'] ."</option>";

                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prodName">Product name:</label>
                            <input type="text" class="form-control" name="prodName" required>
                        </div>

                        <div class="form-group">
                            <label for="mrp">Mrp:</label>
                            <input type="text" class="form-control" name="mrp" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="qty">Quantity:</label>
                            <input type="text" class="form-control" name="qty" required>
                        </div>

                        <div class="form-group">
                            <label for="shortDesc">Short description:</label>
                            <textarea name="short_desc" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="desc">Description:</label>
                            <textarea name="desc" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="meta_desc">Meta description:</label>
                            <textarea name="meta_desc" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta title:</label>
                            <textarea name="meta_title" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="meta_key">Meta keyword:</label>
                            <textarea name="meta_key" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success" id="prodSave" name="prodSave">Save</button>
                    </form>
                </div>
            </div>

            <br>
            <div class="alert" id="msg">
                <strong>Info!</strong> Indicates a neutral informative change or action.
            </div>

        </div>
        <!-- /.col-lg-10 -->

    </div>
    <!-- /.row -->

    <!-- Image Modal -->
    <div id="imageModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <!--    change image    -->
                    <div class="form" id="form" style="display: block">
                        <form action="assets/serverside/ajax-handler.php" method="post">
                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" class="form-control" name="image" required>
                                <input type="hidden" class="form-control" name="imgId" >
                            </div>

                            <input type="submit" class="btn btn-success" name="categoryEdit" value="Save">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container -->

<!-- Footer -->
<?php
require_once 'assets/extracts/footer.html';
?>

<!-- Bootstrap core JavaScript -->
<?php
require_once 'assets/extracts/foot-link.html';
?>


</body>

</html>
