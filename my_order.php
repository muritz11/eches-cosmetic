<?php
//require_once 'resources/php/session.php';

$title = "My order - Eche's cosmetics";

require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/manage_cart.php';


$uid = $user_id;
$order_table = get_table('orders, order_status', 'WHERE user_id='.$uid.' and orders.order_status=order_status.id', 'orders.*, order_status.name');

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
        <div class="mb-5 col-x">
            <h2 class="text-center mb-5">My order</h2>
            <div>
                <div class="table-responsive">
                    <table class="table table-hover text-white">
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
                        <tbody id="table">

                        <?php
                        foreach ($order_table as $item):
                            $date = date_create($item['added_on']);
                            $date = date_format($date, 'd/m/Y');
                            ?>
                            <tr>
                                <td><a class="btn btn-outline-info" href="my_order_detail.php?id=<?= $item['id'] ?>"><?= $item['id'] ?></a></td>
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
