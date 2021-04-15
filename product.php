<?php
require_once 'resources/php/session.php';

$title = "Products - Eche's cosmetics";
$null_cat = '';
$prod_id = 1;

//require_once 'admin/assets/serverside/conn.php';
require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/manage_cart.php';


//get product list based on category
if(isset($_GET['catId']) && !empty($_GET['catId'])){

    extract($_GET);
    $catId = mysqli_real_escape_string($conn, $catId);

    //get our current product
    $cat_items = get_product('', $catId);

    //run a query to get current category
    $sql = "select categories from categories where id=$catId";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)){
        $curCat = $row['categories'];
    }

}else {

    //get all our products
    $cat_items = get_product();
}


if (count($cat_items) == 0){

    $null_cat = 'There are no items in this category yet';

}

//prx($cat_items);
extract($cat_items);

//$path = dirname(__FILE__);
//echo $path;
//
//$current_file = $_SERVER['SCRIPT_FILENAME'];
//echo '<br>'.$current_file;
//
//$current_files = $_SERVER['SCRIPT_URI'];
//echo '<br>'.$current_files;
echo '<br>'.image_path;


//get category table
$cats = get_cats();
//prx($cats);
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

      <hr>
      <div class="pan sacramento">
          <div class="row">
              <div class="col-4">
                  <h6 class="font-weight-bolder">
                  Filter by:
                      <span class="dropdown px-2">
                          <span class="nav-link dropdown-toggle bg-white text-dark d-inline-block" data-toggle="dropdown"><?= isset($curCat) ? $curCat : 'All' ?></span>
                          <ul class="dropdown-menu p-3 mt-0 bg-white">
                              <li><a href="product.php">All</a></li>
                              <?php
                              foreach ($cats as $cat){
                                  echo "<li><a href='product.php?catId=".ucwords($cat['id'])."'>";
                                  echo $cat['categories'];
                                  echo "</a>";
                              }
                              ?>
                          </ul>
                      </span>
                  </h6>
              </div>
              <div class="col-4">
                  <h1 class="text-center d-inline-block font-weight-bolder"><?= isset($curCat) ? $curCat : 'All' ?> </h1>
              </div>
              <div class="col-4">
                  <h3 class="text-right">products: <?= count($cat_items) ?></h3>
              </div>
          </div>
      </div>
      <hr>

    <div class="row">

        <?= "<h4>$null_cat</h4>" ?>
        <?php
        foreach ($cat_items as $item):
            ?>
            <div class="col-lg-3 col-sm-4 col-6 mb-5" id="<?= $prod_id++ ?>">
                <!-- Card-->
                <a href="shop-item.php?itemId=<?= $item['id'] ?>">
                    <div class="card rounded shadow-sm border-0 shop-item">
                        <div class="card-img-cont">
                            <img src="<?= image_path.$item['image'] ?>" alt="product image" class="img-fluid d-block mx-auto
                            mb-3 card-img-top">
                        </div>

                        <div class="hover-anime card-body p-2">
                            <h3> <a href="shop-item.php?itemId=<?= $item['id'] ?>" class="pinky"><?= ucfirst($item['name']) ?></a></h3>
                            <small class="sacramento text-muted"><del><?= $item['mrp'] != 0 ? currency.' '.$item['mrp'] : '' ?></del></small>
                            <p class="sacramento pinky"><?= currency.' '.$item['price'] ?></p>
                            <button title="Add to cart" class="btn btn-outline-success" onclick="crud_cart('add', '<?= $item['id']?>','Item added to cart')" <?= $item['id'] != 0 ? '' : 'disabled' ?>>
                                <i class="fa fa-opencart"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </a>
            </div>

            <?php
        endforeach;
        ?>


    </div>

      <div class="alert" id="msg">
          <strong>Info!</strong> Indicates a neutral informative change or action.
      </div>

      <div class="row m-4">
          <div class="col-4"></div>

          <div class="pagination col-4">
              <button class="btn rounded" id="prev">&lt;</button>
              <div class="page-number">
                <!--    to be dynamically created with js-->
              </div>

              <button class="btn rounded" id="next">&gt;</button>
          </div>

          <div class="col-4"></div>
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
