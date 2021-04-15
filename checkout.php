<?php
require_once 'resources/php/session.php';
//require_once 'resources/php/config.php';


if (!isset($_SESSION['cart'])){
    header('location: index.php');
}


require_once 'admin/assets/serverside/funcs.php';

$sub_total = 0;
$title = "Check out - Eche's cosmetics";

foreach ($_SESSION['cart'] as $pid => $quantity){
    $cart_item = get_product('', '', $pid);
    extract($cart_item[0]);
    $sub_total = $sub_total + ($quantity['qty'] * $price);
}

if (isset($_POST['submit'])) {

    $total = $sub_total + tax;
    $user_id = $_SESSION['user_id'];
    extract($_POST);
    $addr = test_inputs($userAddress);
    $city = test_inputs($userCity);
    $zipcode = test_inputs($userPostal_code);
    $pay_meth = test_inputs($pay_meth);
    $pay_status = 'pending';
//    if ($pay_meth == 'cod'){
//        $pay_status = 'success';
//    }
    $order_status = 1;
    $added_on = date("Y-m-d h:i:sa");

    mysqli_query($conn, "INSERT into  orders(user_id, address, city, zipcode, payment_type, total_price, payment_status, order_status, added_on) VALUES('$user_id', '$addr', '$city', '$zipcode', '$pay_meth', '$total', '$pay_status', '$order_status', '$added_on')");

    $order_id = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $pid => $quantity){
        $cart_item = get_product('', '', $pid);
        extract($cart_item[0]);
        $qty = $quantity['qty'];

        mysqli_query($conn, "INSERT into order_detail(order_id, product_id, qty, price) VALUES ('$order_id', '$pid', '$qty', '$price')");
    }


    unset($_SESSION['cart']);
    header('location: thankyou.php');

}



?>
<!doctype html>
<html lang="en">
<head>

    <?php
    require_once 'resources/extracts/header-links.html';
    ?>

</head>

<body style="background: #dedede">

<div class="mt-5 bg-light text-dark" style="background: #c6c8ca;">

    <div class="row  px-2 mx-auto py-5" style="width: 100%;">

        <div class="col-md-8">

            <?php
            if (!isset($_SESSION['userLogged_in'])):
            ?>
            <button class="accordion active">CHECK OUT METHOD</button>
            <div class="panel p-5" style="display: block">
                <div class='row'>
                    <div class="col-6">
                        <h2 class="text-muted">Login</h2>
                        <p>Please fill in credentials to Login.</p>
                        <form method='POST' id="userLogin">

                            <div class="form-group mt-4">
                                <label for='email'>Email: <sup>*</sup></label>
                                <input type='email' name="userLog_email" id="email" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="form-group mt-4">
                                <label for='password'>Password: <sup>*</sup></label>
                                <input type='password' name="userPasswd" id="password" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="row mt-4">
                                <div class='col-md-4'>
                                    <input type='submit' id="btnLogin_checkout" name='btnLogin' value='Login'
                                           class='btn  btn-block rounded-6 btn-success'>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="col-6">
                        <h2 class="text-muted">Register</h2>
                        <p>Please fill in credentials to Sign Up.</p>
                        <form method='POST' id="userRegister">

                            <div class="form-group mt-4">
                                <label for='username'>Name: <sup>*</sup></label>
                                <input type='text' name="userReg_name" id="username" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>


                            <div class="form-group mt-4">
                                <label for='email'>Email: <sup>*</sup></label>
                                <input type='email' name="email" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="form-group mt-4">
                                <label for='tel'>Mobile number: <sup>*</sup></label>
                                <input type='text' name="user_tel" id="tel" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="form-group mt-4">
                                <label for='password'>Password: <sup>*</sup></label>
                                <input type='password' name="passwd" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>

                            <div class="form-group mt-4">
                                <label for='confirm_password'>Confirm Password: <sup>*</sup></label>
                                <input type='password' name="confirm_password" class='form-control form-control-lg myInputs'>
                                <span class="invalid-feedback"></span>
                            </div>


                            <div class="row mt-4">
                                <div class='col-md-4'>
                                    <input type='submit' id="btnRegister_checkout" name='btnRegister' value='Register'
                                           class='btn  btn-block rounded-6 btn-success'>
                                </div>
                            </div>


                        </form>
                    </div>


                    <div id="msg" class="alert">

                    </div>
                </div>

            </div>

            <?php
            endif;
            ?>

            <form method='POST'>
            <div class="accordion">ADDRESS INFORMATION</div>
            <div class="panel">



                    <div class="form-group mt-4">
                        <label for='addr'>Street Address: <sup>*</sup></label>
                        <input type='text' name="userAddress" id="addr" class='form-control form-control-lg myInputs'>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group mt-4 row">
                        <div class="col-6">
                            <label for='city'>City/state: <sup>*</sup></label>
                            <input type='text' name="userCity" id="city" class='form-control myInputs'>
                            <span class="invalid-feedback"></span>
                        </div>

                        <div class="col-6">
                            <label for='zip'>Postal code/Zip: <sup>*</sup></label>
                            <input type='text' name="userPostal_code" id="zip" class='form-control myInputs'>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>

            </div>

            <div class="accordion">PAYMENT INFORMATION</div>
            <div class="panel">
                <input type="radio" name="pay_meth" value="cod" id="cod"><label for="cod">COD</label> <br>
                <input type="radio" name="pay_meth" value="payu" id="payu"><label for="payu">payU</label>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-block">
                    </div>
                </div>

            </div>

            </form>


        </div>

        <!--  /sect 1      -->


        <!--    order    -->
        <div class="col-md-4">
            <div class="rounded p-5  mx-auto" style="background: #eee;">
                <h3 class="text-muted text-center mb-4">YOUR ORDER</h3>
                <div class="items row">

                    <?php
//                    $tax = 10;
//                    $sub_total = 0;
                    foreach ($_SESSION['cart'] as $pid => $quantity):
                        $cart_item = get_product('', '', $pid);

                        extract($cart_item[0]);
//                        $sub_total = $sub_total + ($quantity['qty'] * $price);

                        ?>

                        <div class="col-6 mt-3"><h6 class=""><?= $name ?></h6><b><?= currency.$price ?></b></div>
                        <div class="col-6 mt-3 text-right"><i class="fa fa-trash-o btn btn-danger btn-sm"></i></div>

                        <?php
                    endforeach;
                    ?>
                </div>

                <hr>
                <div class="row total">
                    <div class="col-6">SUB TOTAL</div>
                    <div class="col-6 text-right"><?= currency.$sub_total ?></div>
                </div>


                <div class="row total">
                    <div class="col-6">TAX</div>
                    <div class="col-6 text-right"><?= currency.tax ?></div>
                </div>

                <hr>
                <div class="row total">
                    <div class="col-6"><p><b>ORDER TOTAL</b></p></div>
                    <div class="col-6 text-right"><?= currency.($sub_total + tax) ?></div>
                </div>

            </div>
        </div>
        <!-- /sect 2 -->

    </div>


</div>

<!-- Footer -->
<?php
require_once 'resources/extracts/footer.html';
?>

<!-- Bootstrap core JavaScript -->
<?php
require_once 'resources/extracts/foot-link.html';
?>


</body>
</html>