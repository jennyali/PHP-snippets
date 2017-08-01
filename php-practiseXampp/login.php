<?php
    session_start();

    $message = '';

if(isset($_POST['name']) && isset($_POST['password'])){
    $db = mysqli_connect('localhost', 'root', '', 'php'); // connects to database name 'php'
    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
        mysqli_real_escape_string($db, $_POST['name'])); // readies the question to database asking for 'name' s that match with what the user typed in the 'name' input field
    $result = mysqli_query($db, $sql); // result = what is found/ not found in database
    $row = mysqli_fetch_assoc($result); // if result is 'true' then this function will put the result values into an Array that can be access via $variable['propertyname']
    if($row) {
        $hash = $row['password'];
        $isAdmin = $row['isAdmin'];

        if(password_verify($_POST['password'], $hash)){
            $message = 'Login SUCCESSFUL';

            $_SESSION['users'] = $row['name'];
            $_SESSION['isAdmin'] = $isAdmin;

        } else {
            $message = 'Login FAILED.'; // means the person exsists but the password entered is wrong
        }

    } else {
        $message = 'Login FAILED.'; // means the user doesn't exsist
    }
    mysqli_close($db);
}

?><!DOCTYPE>
<html>
<head>
    <title>PHP</title>
</head>
<body>
<?php 

readfile('navigation.tmpl.html'); 

echo "<p>$message</p>";

?>


    <form method="post" action="">
        User name <input type="text" name="name"><br>
        Password <input type="password" name="password"><br>
        <input type="submit" value="submit">
    </form>

</body>
</html>