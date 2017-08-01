<?php 
    require_once('database.php');

    $error_msg = "";

    //if user not logged in check cookie first.
    if (!isset($_COOKIE['user_id'])) {
        if(isset($_POST['submit'])) {

            $pdo = Database::connect();

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if(!empty($username) && !empty($password)) {

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT user_id, username FROM fanclub WHERE username = '$username' AND password = SHA('$password')";
                $q = $pdo->prepare($sql);
                $q->execute();
                $data = $q->fetch(PDO::FETCH_ASSOC);

                var_dump($data);

                if($data > 0) {

                    setcookie('user_id', $data['user_id']);
                    setcookie('username', $data['username']);
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';

                    header('Location: ' . $home_url);
                } else {

                    $error_msg = 'Sorry, you must enter a valid username and password';
                }
            } else {

                $error_msg = 'Sorry, you must fill in a username and password';
            }

            Database::disconnect();
        }
    }
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div>


            <?php 
                if (empty($_COOKIE['user_id'])) {
                    echo '<p>' . $error_msg . '</p>';
                
            ?>

        </div>

        <h3 class="jumbotron">GROOVY FANCLUB</h3>
            <a href="index.php">Back</a>

        <p>Please enter a username and password to log in.</p>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <legend>Log in Form</legend>

                <label for="username">username:</label>
                <input type="text" name="username" value="<?php if (!empty($username)) echo $username; ?>" /></br>

                <label for="password">password:</label>
                <input type="password" name="password" /></br>

            </fieldset>

            <button type="submit" name="submit">log in</button>
        </form>

            <?php 
                } else {
                    echo('<p>You are logged in as ' . $_COOKIE['username'] . '.</p>');
                }
            ?>
</body>
</html>