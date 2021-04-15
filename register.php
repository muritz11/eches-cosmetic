<?php
$title = "Register - Eche's cosmetics";

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

                    <div id="msg" class="alert">

                    </div>

                    <div class="row mt-4">
                        <div class='col-md-4'>
                            <input type='submit' id="btnRegister" name='btnRegister' value='Register'
                                   class='btn  btn-block rounded-6 btn-success'>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col'>

                            <a href="login.php" class="btn btn-block text-white">Have account? Login</a>

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