<?php

session_start();
// below means if 'isAdmin' is NOT set OR the isAdmin is FALSE then do the following
if(!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    header('Location: login.php'); // redirects user to the login page.
}

?>