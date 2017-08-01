<?php 

 require 'auth.php';

// this php code says if it can't find an id from the database to redirect to another page(select.php page)'
    if (isset($_GET['id']) && ctype_digit($_GET['id'])){
        $id = $_GET['id'];
    } else {
        header('Location: select.php');
    }
?><!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
</head>
<body>
    <?php     readfile('navigation.tmpl.html'); // this code loads the whole external HTML page called 'navigation.html'.
    // require() in php only takes the php from an external file.
    ?>

    <p><?php

        $name = '';
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
            if(!isset($_POST['drink']) || $_POST['drink'] === '') {
                $ok = false;
            } else {
                $drink = $_POST['drink'];
            }  
            if(!isset($_POST['fruit']) || $_POST['fruit'] === '') {
                $ok = false;
            } else {
                $fruit = $_POST['fruit'];
            }


            if($ok) {
                //this code updates the values in the database, giving values to given id
                $db = mysqli_connect('localhost', 'root', '', 'php'); // this code connects to database and stores it in a variable
                $sql = sprintf("UPDATE users SET name='%s', drink='%s', fruit='%s'
                    WHERE id=%s",
                    mysqli_real_escape_string($db, $name),
                    mysqli_real_escape_string($db, $drink),
                    mysqli_real_escape_string($db, $fruit),
                    $id); // this code is the SQL that is going to use its update function
                mysqli_query($db, $sql); // this code 'querys' the database with the given database and function.
                echo '<p> User updated. </p>'; 
                mysqli_close($db); //closes connection to database

            }
        } else {
            // this code is going to prefill values in the 'form' with values from the database that go with each person
            $db = mysqli_connect('localhost', 'root', '', 'php');
            $sql = sprintf('SELECT * FROM users WHERE id = %s', $id);
            $result = mysqli_query($db, $sql);
            foreach ($result as $row){
                $name = $row['name'];
                $drink = $row['drink'];
                $fruit = $row['fruit'];
            }
            mysqli_close($db);
        }
    ?></p>

    <form method="post" action="">
        User Name: 
        <input type="text" name="name" value="<?php 
            echo htmlspecialchars($name);
        ?>"><br> <!-- the php here is telling the input that if left, then grab the value from last time, which is stored in the varibable -->
        
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