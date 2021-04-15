<?php
require_once 'resources/php/session.php';

$title = "Eche's cosmetics - Home";
require_once 'admin/assets/serverside/conn.php';
require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/manage_cart.php';

$latest_product = get_product(8);
$cats = get_cats();



//prx($latest_product);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  require_once 'resources/extracts/header-links.html';
  ?>

</head>

<body>



  <div class="header">

      <!-- Navigation -->
      <?php
      require_once 'resources/extracts/navbar.html';
      ?>


      <div class="text-center animate__animated animate__slideInUp animate__slow">
          <h1 class="banner-title">Welcome to eche's cosmetic</h1>
      </div>

  </div>

  <!-- Page Content -->
  <div class="container mt-5">

      <div class="new-arrv">

          <div class="m-5">
              <h3 class="text-center sect-title">NEW ARRIVALS</h3>
              <hr class="hr rounded">
          </div>

          <div class="row">

              <?php
              foreach ($latest_product as $item):
              ?>
                  <div class="col-lg-3 col-sm-4 col-6 mb-5">
                      <!-- Card-->
                      <a href="shop-item.php?itemId=<?= $item['id'] ?>">
                          <div class="card rounded shadow-sm border-0">
                              <div class="card-img-cont">
                                  <img src="<?= 'admin/'.$item['image'] ?>" alt="product image" class="img-fluid d-block mx-auto mb-3 card-img-top">
                              </div>

                              <div class="hover-anime card-body p-2">
                                  <h3> <a href="shop-item.php?itemId=<?= $item['id'] ?>" class="pinky"><?= $item['name'] ?></a></h3>
                                  <p class="sacramento text-muted"><del><?= $item['mrp'] != 0 ? currency.' '.$item['mrp'] : ' ' ?></del></p>
                                  <p class="sacramento pinky"><?= currency." ".$item['price'] ?></p>
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
          <!-- /.row -->

          <div class="alert" id="msg">
              <strong>Info!</strong> Indicates a neutral informative change or action.
          </div>
          <div class="text-center mt-5 x-kg"><a href="product.php" style="font-size: 1.7em" class="font-weight-bolder btn btn-link btn-lg sacramento">See all</a></div>
      </div>
      <!-- /new arrivals -->

      <hr>



      <div class="Collections mt-5" id="collections">

          <div class="m-5">
              <h2 class="text-center sect-title">Collections</h2>
              <hr class="hr rounded">
          </div>

          <div class="row">

              <?php
              foreach ($cats as $item):
                  ?>
                  <div class="col-lg-3 col-sm-4 col-6 mb-4">
                      <!-- Card-->
                      <a href="product.php?catId=<?= $item['id'] ?>">
                          <div class="card rounded shadow-sm border-0">
<!--                              <img src="--><?//= 'admin/'.$item['image'] ?><!--" alt="product image" class="img-fluid d-block mx-auto mb-3 card-img-top">-->
                              <div class="card-body p-4">
                                  <h3> <a href="product.php?catId=<?= $item['id'] ?>" class="pinky"><?= $item['categories'] ?></a></h3>
                              </div>
                          </div>
                      </a>
                  </div>

                  <?php
              endforeach;
              ?>

          </div>
          <!-- /.row -->

      </div>
      <!-- /collections -->

  </div>
  <!-- /.container -->


  <!-- carousel-->
  <div id="carouselExampleIndicators" class="carousel slide mt-4" data-ride="carousel">
      <ol class="carousel-indicators text-muted">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
              <img class="d-block img-fluid carousel-img" src="resources/images/pexels-2.jpg" alt="First slide">
              <div class="carousel-caption sacramento">
                  <h1>Los Angeles</h1>
                  <h3 class="x-kg">LA is always so much fun!</h3>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block img-fluid carousel-img" src="resources/images/pexels-3.jpg" alt="Second slide">
              <div class="carousel-caption sacramento">
                  <h1>Los asdsa</h1>
                  <h3 class="x-kg">LA so much fun!</h3>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block img-fluid carousel-img" src="resources/images/pexels-4.jpg" alt="Third slide">
              <div class="carousel-caption sacramento">
                  <h1>Angeles</h1>
                  <h3 class="x-kg">so much fun!</h3>
              </div>
          </div>
          <div class="carousel-item">
              <img class="d-block img-fluid carousel-img" src="resources/images/pexels-1.jpg" alt="Third slide">
              <div class="carousel-caption sacramento">
                  <h1>Leles</h1>
                  <h3 class="x-kg">ways so much fun!</h3>
              </div>
          </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
  </div>

  <!-- Footer -->
  <?php
  require_once 'resources/extracts/footer.html';
  ?>

  <?php
  require_once 'resources/extracts/foot-link.html';
  ?>

</body>

</html>
