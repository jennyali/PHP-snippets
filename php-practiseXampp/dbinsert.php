<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
</head>
<body>

    <?php 
        readfile('navigation.tmpl.html'); // this code loads the whole external HTML page called 'navigation.html'.
    // require() in php only takes the php from an external file.
    ?>

    <p><?php

    //below are declared varibles using $ 
        $name = '';
        $password = '';
        $drink = '';
        $fruit = '';


        if (isset($_POST['submit'])){
            $ok = true;

            // below are sets of validations to check the data being submited
            if(!isset($_POST['name']) || $_POST['name'] === '') {
                $ok = false;
            } else {
                $name = $_POST['name'];
            }
            if(!isset($_POST['password']) || $_POST['password'] === '') {
                $ok = false;
            } else {
                $password = $_POST['password'];
            }
            if(!isset($_POST['drink']) || $_POST['drink'] === '') {
                $ok = false;
            } else {
                $drink = $_POST['drink'];
            }  
            if(!isset($_POST['fruit']) || $_POST['fruit'] === '') {
                $ok = false;
            } else {
                $fruit = $_POST['fruit'];
            } // whats happeing is its saying IF the user doesn't set a value or the value then $ok = false and the submit fails to happen
            // but if the person does enter a value then the corrosponding variable gets that value.


            if($ok) {
                $hash = password_hash($password, PASSWORD_DEFAULT); // this is the function that 'encrpts' the password, in a new variable to send to the data base.


                $db = mysqli_connect('localhost', 'root', '', 'php');
                $sql = sprintf("INSERT INTO users (name, password, drink, fruit) VALUES (
                    '%s', '%s', '%s', '%s'
                    )", mysqli_real_escape_string($db, $name),
                        mysqli_real_escape_string($db, $hash),
                        mysqli_real_escape_string($db, $drink),
                        mysqli_real_escape_string($db, $fruit));
                    mysqli_query($db, $sql);
                    mysqli_close($db);
                    echo '<p>User added. </p>';
            } // this if block says IF $ok becomes true THEN make the call to the database otherwise NOT.
        }
    ?></p>

    <!-- 
        IN ABOVE PHP SCRIPT
        1, connected to database, via localhost with login details and database namespace
        2, sql statment making sure special characters escaped.
    -->

    <form method="post" action="">
        User Name: 
        <input type="text" name="name" value="<?php 
            echo htmlspecialchars($name);
        ?>"><br> <!-- the php here is telling the input that if left, then grab the value from last time, which is stored in the varibable -->
        
        Password: 
        <input type="password" name="password" value=""><br>



        My favourite Drink is:
        <input type="radio" name="drink" value="coffee">Coffee
        <input type="radio" name="drink" value="tea">tea<br>

        Favourite fruit:
        <select name="fruit">
            <option value="">Please select</option>
            <option value="apple" <?php 
                if($fruit === 'apple'){
                    echo ' selected';
                }
            ?>>apple</option>
            <option value="banana" <?php 
                if($fruit === 'banana'){
                    echo ' selected';
                }
            ?>>banana</option>
            <option value="grape" <?php 
                if($fruit === 'grape'){
                    echo ' selected';
                }
            ?>>grape</option>
        </select><br>

        <br><input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>