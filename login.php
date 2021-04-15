<?php
$title = "Login - Eche's cosmetics";

?>
<!doctype html>
<html lang="en">
<head>

    <?php
    require_once 'resources/extracts/header-links.html';
    ?>

</head>

<body>
<div class="container" style="padding-top: 56px">


    <div class="row">

        <div class="col-md-6 mx-auto p-3">
            <div class='p-4 myForm mt-2 mb-5 text-white'>
                <h2 class="text-muted">Login</h2>
                <p>Please fill in credentials to Login.</p>
                <form method='POST' id="userLogin">

                    <div class="form-group mt-4">
                        <label for='email'>Email: <sup>*</sup></label>
                        <input type='email' name="userLog_email" class='form-control form-control-lg myInputs'>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group mt-4">
                        <label for='password'>Password: <sup>*</sup></label>
                        <input type='password' name="userPasswd" class='form-control form-control-lg myInputs'>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div id="msg" class="alert">

                    </div>

                    <div class="row mt-4">
                        <div class='col-md-4'>
                            <input type='submit' id="btnLogin" name='btnLogin' value='Login'
                                   class='btn  btn-block rounded-6 btn-success'>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col'>

                            <a href="register.php" class="btn btn-block text-white">Don't have an account? Register</a>

                        </div>
                    </div>


                </form>

            </div>
        </div>

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