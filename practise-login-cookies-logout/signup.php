<?php

    require_once('database.php');


    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if(isset($_POST['submit'])) {

        //data posted from form. 
        $username = trim($_POST['username']);
        $password1 = trim($_POST['password1']);
        $password2 = trim($_POST['password2']);

        if(!empty($username) && !empty($password1) && !empty($password2) &&
            ($password1 == $password2)) {
            
            $sql = "SELECT * FROM fanclub WHERE username = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            $data = $q->fetch(PDO::FETCH_ASSOC);

            //check if user exists
            if ($data == 0) {
                
                // if no user does then insert new user
                $sql = "INSERT INTO fanclub (username, password, join_date) VALUES".
                        "('$username', SHA('$password1'), NOW())";
                $q = $pdo->prepare($sql);
                $q->execute();

                // success msg
                echo '<p>Your new Account has been created. You are now ready to login in and '.
                    '<a href="editprofile.php">edit your profile</a>.</p>';

                Database::disconnect();
                exit(); 

            } else {

                //if user does exists
                echo '<p>Sorry this an account already exists please try a different username.</p>';

                $username = '';
            }

        } else {

            echo '<p>You must fill in all the form fields to sign up.</p>';            
        }
    }

    Database::disconnect();

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
            <h3 class="jumbotron">GROOVY FANCLUB SIGN UP</h3>
            <a href="index.php">Back</a>
        </div>

        <p>Please enter a username and password to sign up.</p>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <legend>Registration Form</legend>

                <label for="username">username:</label>
                <input type="text" name="username" value="<?php if (!empty($username)) echo $username; ?>" /></br>

                <label for="password1">password:</label>
                <input type="password" name="password1" value="<?php if(!empty($password1)) echo $password1; ?>" /></br>

                <label for="password2">re-type password:</label>
                <input type="password" name="password2" value="<?php if(!empty($password2)) echo $password1; ?>" /></br>
            </fieldset>

            <button type="submit" name="submit">Submit</button>
        </form>


</body>

</html>