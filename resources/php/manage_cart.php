<?php
require_once 'add_cart.php';


//total items in cart || if any
$ptotal = new add_cart();


if (isset($_POST['pid'])){

    extract($_POST);
    $obj = new add_cart();

    if ($type == 'add'){
        $obj->addProduct($pid, 1);
        echo 'ok';
    }

    if ($type == 'remove'){
        $obj->removeProduct($pid);
        echo 'ok';
    }

    if ($type == 'update'){
        $obj->updateProduct($pid, $qty);
        echo 'ok';
    }

}


$total_product = $ptotal->totalProduct();