<?php
require_once 'assets/serverside/session_start.php';

$title = "Eche's - users";
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
            <div class="alert" id="msg">
                <strong>Info!</strong> Indicates a neutral informative change or action.
            </div>
            <!-- content goes here-->
            <div class="card radii p-2">
                <h4 class="p-2">Users</h4>
                <div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>MOBILE</th>
                                <th>DATE</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="table">

                            </tbody>
                        </table>
                    </div>
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

<!-- Bootstrap core JavaScript -->
<?php
require_once 'assets/extracts/foot-link.html';
?>


<script>
    var curPage = $('#user');

    <?php
    if (getCurPage() == 'users.php'){
        echo 'activePage(curPage);';
    }

    ?>
</script>
</body>

</html>
