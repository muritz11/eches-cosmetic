<?php

session_start();

//session_unset($_SESSION['userLogged_in']));
//unset($_SESSION['userLogged_in']));
unset($_SESSION['userLogged_in']);

header('Location: index.php');