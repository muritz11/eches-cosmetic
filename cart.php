<?php
//require_once 'resources/php/session.php';

$title = "My cart - Eche's cosmetics";

require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/add_cart.php';
require_once 'resources/php/manage_cart.php';

if (!isset($_SESSION['cart'])){
//    header('location: index.php');
//    supposed to echo a msg 'you have no item in cart yet'
}

$no_cart = "<h3>You have no item in cart yet</h3>"


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
            <h2 class="text-center">My cart</h2>
            <h5 class="text-center mb-4 keep"><a href="index.php" class="text-center text-white">Keep shopping</a></h5>
            <div>
                <?php
                if (isset($_SESSION['cart'])):
                    $no_cart = '';
                ?>
                <div class="table-responsive">
                    <table class="table table-hover text-white">
                        <thead>
                        <tr>
                            <th>PRODUCT</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="table">
                        <?php
                        $sub_total = 0;
                        foreach ($_SESSION['cart'] as $pid => $quantity):
                        $cart_item = get_product('', '', $pid);

                        extract($cart_item[0]);
                        $sub_total = $sub_total + ($quantity['qty'] * $price);

//                        prx($_SESSION['cart']);
                        ?>
                            <tr>
                                <td><?= $name ?></td>
                                <td><?= $price ?></td>
                                <td>
                                    <input type="number" value="<?= $_SESSION['cart'][$id]['qty'] ?>" min="1"
                                           class="qtyInput">
                                    <a href="#" class="btn btn-outline-primary upd" pid="<?= $id ?>">Update</a>

                                </td>
                                <td><?= $quantity['qty'] * $price ?></td>
                                <td><i class="fa fa-trash btn btn-danger" title="Remove" onclick="crud_cart('remove', '<?= $id ?>', 'Item removed')" id="remove_item"></i></td>
                            </tr>

                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>


                <div class="row total m-4">
                    <div class="col-6 text-right font-weight-bold">SUB TOTAL</div>
                    <div class="col-6 text-right font-weight-bold"><?= currency.' '.$sub_total ?></div>
                </div>
                <div class="text-right m-3"><sup>*</sup> Tax and shipping are calculated at checkout</div>

                <?php
                endif;
                ?>

                <?php
                echo $no_cart;
                ?>
            </div>


            <?php
            if (isset($_SESSION['cart'])):
            ?>
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6 text-right">
                    <a href="checkout.php" class="btn btn-outline-primary">Check out</a>
                </div>
            </div>
            <?php
            endif;
            ?>

        </div>


    </div>

    <div class="alert" id="msg">
        <strong>Info!</strong> Indicates a neutral informative change or action.
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
