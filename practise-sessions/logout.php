<?php 
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);

    echo 'you have cleaned session';
    header("Location: login.php");

?>