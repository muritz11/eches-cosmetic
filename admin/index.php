<?php
require_once 'assets/serverside/session_start.php';

$title = "Eche's - Admin";
require_once 'assets/serverside/funcs.php';
include_once 'assets/serverside/conn.php';

if (isset($_GET['type']) && $_GET['type'] == 'status'){

    if ($_GET['opt'] == 'activate'){

        $status = "1";

    } else {

        $status = "0";

    }

    $id = $_GET["id"];

    $upd_status = "UPDATE categories SET status='$status' WHERE id='$id'";

    $conn->query($upd_status);
}

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
            <div class="alert" id="msg">
                <strong>Info!</strong> Indicates a neutral informative change or action.
            </div>
        <!-- content goes here-->
            <div class="card radii p-2">
                <h4 class="p-2">Categories</h4>
                <h5 id="add-cat" class="p-2">
                    <span class="bfor">Add category</span>
                    <span class="after"><i class="fa fa-chevron-circle-left"></i> Back</span>
                </h5>
                <div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>CATEGORIES</th>
                                <th class="text-center">STATUS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="table">

                            </tbody>
                        </table>
                    </div>
                </div>

                <!--    add category form    -->
                <div class="form" id="form">
                    <form method="post" id="frmCategory">
                        <div class="form-group">
                            <label for="category">Category name:</label>
                            <input type="text" class="form-control" id="category" name="category" >
                        </div>
                        <button type="submit" class="btn btn-success" id="catSave" name="saveCat">Save</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.col-lg-10 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php
  require_once 'assets/extracts/footer.html';
  ?>

  <?php
  require_once 'assets/extracts/foot-link.html';
  ?>

</body>

</html>
