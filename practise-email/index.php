<?php

    if (!empty($_POST)) {

        $email = $_POST['email'];
        $emailError = null;

        $valid = true;

        if (empty($email)) {
            $emailError = 'Please enter an Email Address';
            $valid = false;
        } else if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        if($valid) {

            $subject = "Awesome Club";
            $msg = "Welcome! you have joined the Awesome Club.";
            $headers = "From: ".$email."\r\n";

            mail($email,$subject,$msg,$headers);

            //header("Location: index.php?success=true");

        }

    }

?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Email Practise</title>
    </head>

    <body>
        <h2>Subscribe to Awesome Club</h2>

        <?php if(!empty($_GET['success']) && $_GET['success'] = true ) {
            echo '<p style="color:green">Success! an email has been sent.</p>';
        }?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

            <label for="email">Email Address: </label>
            <input type="email" name="email"/>

            </br>

            <button type="submit" name="submit">Sign up!</button>

        </form>

    </body>

</html>