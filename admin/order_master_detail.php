<?php
require_once 'assets/serverside/session_start.php';

$title = "Eche's admin - Order";
require_once 'assets/serverside/funcs.php';

$order_id = $_GET['id'];
$order_table = get_table('order_detail,product', 'WHERE order_detail.order_id='.$order_id.' and order_detail.product_id=product.id', 'distinct(order_detail.id),order_detail.*,product.name,product.image');
$get_status = get_table('order_status,orders', 'WHERE orders.id='.$order_id.' and orders.order_status=order_status.id',
    'order_status.*');
$get_address = get_table('orders', 'WHERE orders.id='.$order_id, 'orders.address,orders.city');
//prx($get_address);



if (isset($_POST['save'])){

    extract($_POST);
    $sql = "UPDATE orders SET order_status='$update_orderStatus' WHERE id=$order_id";

    $run = $conn->query($sql);
    header('location: order_master_detail.php?id='.$order_id);

    if (!$run) {
        echo "Error updating record: " . $conn->error;
    }

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
            <!-- content goes here-->
            <div class="card radii p-2">
                <h4 class="p-2">Order detail</h4>
                <div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>PRODUCT IMAGE</th>
                                <th>PRODUCT NAME</th>
                                <th>QTY</th>
                                <th>PRICE</th>
                                <th>TOTAL PRICE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total_price = 0;
                            foreach ($order_table as $item):
                                $total_price = $total_price + ($item['qty']*$item['price']);
//                                $address = $item['address'];
//                                $city = $item['city'];
//                                $order_status = $item['order_status'];
                                ?>
                                <tr>
                                    <td class="text-center"><img src="<?= $item['image'] ?>" alt="product image" class="table-img rounded mx-auto"></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['qty'] ?></td>
                                    <td><?= $item['price'] ?></td>
                                    <td><?= $item['qty']*$item['price'] ?></td>
                                </tr>

                                <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row total m-4">
                        <div class="col-6 text-right font-weight-bold">TOTAL PRICE</div>
                        <div class="col-6 text-right font-weight-bold">$<?= $total_price ?></div>
                    </div>


                    <div class="mb-2">
                        <strong>Address: </strong>
                        <span><?= $get_address[0]['address'].', '.$get_address[0]['city'] ?></span>
                        <br>

                        <strong>Order status: </strong>
                        <span><?php

                            //                            prx($get_status);
                            echo $get_status[0]['name'];

                            ?>
                        </span>
                    </div>

                    <div>
                        <!--  form to update order status-->
                        <form action="" method="post">
                            <div class="form-group">
                                <select name="update_orderStatus" class="form-control">
                                    <option value="">select status</option>
                                    <?php
                                    $opts = get_table('order_status');

                                    foreach ($opts as $opt){

                                        extract($opt);
                                        echo "<option";
                                        echo " value='$id'";
                                        echo $id == $get_status[0]['id'] ? 'selected >' : '>';
                                        echo $name;
                                        echo "</option>";

                                    }
                                    ?>
                                </select>
                                <input type="submit" name="save" class="form-control btn-success">
                            </div>
                        </form>
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
