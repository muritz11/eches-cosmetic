<?php
$title = "Login admin - Eche's admin";

?>
<!doctype html>
<html lang="en">
<head>

    <?php
    require_once 'assets/extracts/header-links.html';
    ?>

</head>

<body>
<div class="container bg-light">


    <div class="row">

        <div class="col-md-6 mx-auto">
            <div class='card card-body mt-2 mb-5'>
                <h2 class="text-muted">Login</h2>
                <p>Please fill in credentials to Login.</p>
                <form method='POST' id="frmLogin">

                    <div class="form-group mt-4">
                        <label for='username'>Username: <sup>*</sup></label>
                        <input type='text' name="log_username" id="username" class='form-control form-control-lg myInputs'>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group mt-4">
                        <label for='password'>Password: <sup>*</sup></label>
                        <input type='password' name="passwd" class='form-control form-control-lg myInputs'>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div id="msg" class="alert">

                    </div>

                    <div class="row mt-4">
                        <div class='col-4'>
                            <input type='submit' id="btnLogin" name='btnLogin' value='Login'
                                   class='btn  btn-block rounded-6 btn-success'>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col'>

                            <a href="register.php" class="btn  btn-block">Don't have an account? Register</a>

                        </div>
                    </div>


                </form>

            </div>
        </div>

    </div>


</div>

<!-- Footer -->
<?php
require_once 'assets/extracts/footer.html';
?>

<!-- Bootstrap core JavaScript -->
<?php
require_once 'assets/extracts/foot-link.html';
?>


</body>
</html>