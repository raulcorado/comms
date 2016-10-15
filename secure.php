<?php

include 'app/mivar.php';

session_start();

if (isset($_SESSION['login_status']) == false) {
    header('Location:login.php');
}

if ($_SESSION['sessionapp'] <> MIAPP) {
    header('location:logout.php'); //to redirect back to "index.php" after logging out
}


?>
