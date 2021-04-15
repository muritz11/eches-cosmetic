<?php
session_start();
include 'config.php';

if (isset($_SESSION['userLogged_in'])){


    $user  = $_SESSION['user_email'];
    $user_id = $_SESSION['user_id'];

}
