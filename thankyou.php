<?php
//require_once 'resources/php/session.php';

$title = "Thank you - Eche's cosmetics";

require_once 'admin/assets/serverside/funcs.php';
require_once 'resources/php/manage_cart.php';


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
            <h2 class="text-center">Thank you</h2>
            <h5 class="text-center mb-4">Your order has been placed successfully</h5>
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
