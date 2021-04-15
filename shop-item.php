<?php
require_once 'resources/php/session.php';

require_once 'admin/assets/serverside/conn.php';
require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/manage_cart.php';

$cart_btn = '<a href="javascript:void(0)" title="Add to cart" class="btn btn-outline-success" onclick="crud_cart(\'add\', \'<?= $id?>\',\'Item added to cart\')"><i class="fa fa-opencart"></i></a>';

if(isset($_GET['itemId']) && !empty($_GET['itemId'])){

    extract($_GET);
    $itemId = mysqli_real_escape_string($conn, $itemId);

}

//get our current product
$shop_item = get_product('', '', $itemId);
extract($shop_item[0]);


$title = $name." - Eche's cosmetics";
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

    <div class="row">

      <div class="col-lg-3">

          <div class="card mt-4 pinky">
              <div class="card-img-cont">
                  <img src="<?= 'admin/'.$image ?>" alt="product image" class="img-fluid d-block mx-auto mb-3 card-img-top">
              </div>
              <div class="card-body">
                  <p class="card-text"><?= $short_desc ?></p>
              </div>
          </div>
          <!-- /.card -->

      </div>
      <!-- /.col-lg-3 -->



      <div class="col-lg-9">
        <div class="card card-outline-secondary my-4 pinky">
          <div class="card-header">
              <div class="row">
                  <div class="col-6">
                      <h3 class="card-title"><?= ucfirst($name) ?></h3>
                      <h4><del class="text-muted"><?= $mrp != 0 ? currency.' '.$mrp : '' ?></del> <?= currency.' '.$price
                          ?></h4>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <p><strong>Available: </strong><?= $qty != 0 ? 'in stock' : "Sold out" ?></p>
              <p><strong>Category: </strong> <?= $categories ?></p>

              <p><?= $descrip ?></p>
            <hr>
              <button title="Add to cart" class="btn btn-outline-success" onclick="crud_cart('add', '<?= $id?>','Item added to cart')" <?= $qty != 0 ? '' : 'disabled' ?>>
                  <i class="fa fa-opencart"></i>
                  Add to cart
              </button>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

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
