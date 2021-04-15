<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){

    $user = $_SESSION['logged_user'];

} else {

    header("location:login.php");

}
