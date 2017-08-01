<?php 
    $username = 'Admin';
    $password = '1234';

    if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {

            header('HTTP/1.1 401 Unauthorized');
            header('WWW-Authenticate: Basic realm="practise-auth"');
            exit('<h2>Practise Auth</h2>Sorry, you must enter a valid user name and password to access this page.');
        }


?>