<?php
//require_once 'resources/php/session.php';

$title = "Order detail - Eche's cosmetics";

require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/manage_cart.php';


$uid = $user_id;
$order_id = mysqli_real_escape_string($conn, $_GET['id']);
$order_table = get_table('order_detail,product,orders', 'WHERE order_detail.order_id='.$order_id.' and orders.user_id='.$uid.' and product.id=order_detail.product_id', 'distinct(order_detail.id),order_detail.*,product.name,product.image');


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once 'resources/extracts/header-links.html';
    ?>

</head>

<body>

<div class="mybg-blue">

    <!-- Navigation -->
    <?php
    require_once 'resources/extracts/navbar.html';
    ?>

</div>
<!-- Page Content -->
<div class="container">

    <div class="animate__animated animate__slideInUp">

        <!-- content goes here-->
        <div class="mb-5">
            <h2 class="text-center mb-5">Order detail</h2>
            <div>
                <div class="table-responsive">
                    <table class="table table-hover text-white">
                        <thead>
                        <tr>
                            <th>PRODUCT IMAGE</th>
                            <th>PRODUCT NAME</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>TOTAL PRICE</th>
                        </tr>
                        </thead>
                        <tbody id="table">

                        <?php
                        $total_price = 0;
                        foreach ($order_table as $item):
                            $total_price = $total_price + ($item['qty']*$item['price']);
                            ?>
                            <tr>
                                <td class="text-center"><img src="<?= 'admin/'.$item['image'] ?>" alt="product image" class="table-img rounded mx-auto"></td>
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

            </div>

        </div>


    </div>


</div>
<!-- /.container -->

<!-- Footer -->
<?php
require_once 'resources/extracts/footer.html';
?>

<?php
require_once 'resources/extracts/foot-link.html';
?>

</body>

</html>
