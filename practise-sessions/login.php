<?php 
    ob_start();
    session_start();
?>

<!DOCTYPE html>

<html lang = "en">
    <head>
        <title>Login Practise</title>
    </head>

    <body>
        <div>
            <h2>Login Form</h2>
        </div>
        <div>
            <?php 
                $msg = '';

                if (isset($_POST['login']) && !empty($_POST['username'])
                    && !empty($_POST['password'])) {
                    
                    if ($_POST['username'] == 'max' && $_POST['password'] == 1234) {
                        $_SESSION['valid'] = true;
                        $_SESSION['timeout'] = time();
                        $_SESSION['username'] = 'max';

                        echo 'You have entered valid username and password';
                    } else {
                        $msg = 'Wrong username or password';
                    }
                }
            ?>
        </div>

        <div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <h4><?php echo $msg; ?></h4>
                <input type="text" name="username" placeholder="max" required></br>
                <input type="password" name="password" placeholder="1234" required></br>
                <button type="submit" name="login">Login</button>
            </form>

            Click here to <a href="logout.php" title="Logout">leave session.</a>

        </div>
    </body>

</html>