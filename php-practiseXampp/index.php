<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
</head>
<body>
    <p><?php
    //below are declared varibles using $ 
        $name = '';
        $cat = '';
        $drink = '';
        $tc = '';
        $fruit = '';
        $list = array();

        if (isset($_POST['submit'])){
            $ok = true;

            // below are sets of validations to check the data being submited
            if(!isset($_POST['name']) || $_POST['name'] === '') {
                $ok = false;
            } else {
                $name = $_POST['name'];
            }
            if(!isset($_POST['cat']) || $_POST['cat'] === '') {
                $ok = false;
            } else {
                $cat = $_POST['cat'];
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
            if(!isset($_POST['tc']) || $_POST['tc'] === '') {
                $ok = false;
            } else {
                $tc = $_POST['tc'];
            }

            if(!isset($_POST['list']) || !is_array($_POST['list']) ||
                count($_POST['list']) === 0) {
                // related to multiselect list, logic reads; 'list is not set or is not an array or the array count of items is 0 (nothing)'
                $ok = false;
            } else {
                $list = $_POST['list'];
            }


            if($ok) { // the output to display if all conditions i.e. inputs are true.
                printf('
                User name: %s
                <br>My Cats name is: %s
                <br>I like to drink: %s
                <br>My favourite fruit is: %s
                <br>I %s to the terms and conditions
                <br>I like %s
                ', 
                htmlspecialchars($name), // htmlspecialchars() escapes HTML code so if user types html tags the browser doesn't render them.
                htmlspecialchars($cat),
                htmlspecialchars($drink),
                htmlspecialchars($fruit),
                htmlspecialchars($tc),
                htmlspecialchars(implode(' ', $list))); // implode takes the array items and glues them together, in this case with a space '  '
            }
        }


    ?></p>

    <form method="post" action="">
        User Name: 
        <input type="text" name="name" value="<?php 
            echo htmlspecialchars($name);
        ?>"><br> <!-- the php here is telling the input that if left, then grab the value from last time, which is stored in the varibable -->

        Cat's name:
        <input type="text" name="cat" value="<?php
            echo htmlspecialchars($cat);
        ?>"><br>

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

        Terms and Conditions: 
        <input type="checkbox" name="tc" value="agree"><br>

        Pick a number:
        <select multiple name="list[]" size="3"> <!-- for multiselect lists in php use implode() to access the items in the array -->
            <option value="item1" <?php 
                if(in_array('item1', $list)){
                    echo ' selected';
                }
            ?>>one</option>
            <option value="item2" <?php 
                if(in_array('item2', $list)){
                    echo ' selected';
                }
            ?>>two</option>
            <option value="item3" <?php 
                if(in_array('item3', $list)){
                    echo ' selected';
                }
            ?>>three</option>
        </select>

        <br><input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>