<?php
require_once 'assets/serverside/session_start.php';

$title = "Eche's - Order";
require_once 'assets/serverside/funcs.php';

$order_table = get_table('orders, order_status', 'WHERE orders.order_status=order_status.id order by orders.id desc',
    'orders.*, order_status.name');

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
                <h4 class="p-2">Orders</h4>
                <div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ORDER ID</th>
                                <th>ORDER DATE</th>
                                <th>ADDRESS</th>
                                <th>PAYMENT TYPE</th>
                                <th>PAYMENT STATUS</th>
                                <th>ORDER STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($order_table as $item):
                                $date = date_create($item['added_on']);
                                $date = date_format($date, 'd/m/Y');
                                ?>
                                <tr>
                                    <td><a class="btn btn-outline-info" href="order_master_detail.php?id=<?= $item['id'] ?>"><?= $item['id'] ?></a></td>
                                    <td><?= $date ?></td>
                                    <td>
                                        <?= $item['address'] ?><br>
                                        <?= $item['city'] ?><br>
                                        <?= $item['zipcode'] ?>
                                    </td>
                                    <td><?= $item['payment_type'] ?></td>
                                    <td><?= $item['payment_status'] ?></td>
                                    <td><?= $item['name'] ?></td>
                                </tr>

                                <?php
                            endforeach;
                            ?>
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
    var curPage = $('#order');

    <?php
    if (getCurPage() == 'order.php'){
        echo 'activePage(curPage);';
    }

    ?>
</script>
</body>

</html>
