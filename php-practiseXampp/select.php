<?php 
 require 'auth.php';
?>
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


<ul><?php
        $db = mysqli_connect('localhost', 'root', '', 'php');
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($db, $sql);
        
        foreach ($result as $row) {
            printf('<li>%s favourite drink is %s and fruit is %s
            <a href="update.php?id=%s">edit</a>
            <a href="delete.php?id=%s">delete</a>
            </li>',
                htmlspecialchars($row['name']),
                htmlspecialchars($row['drink']),
                htmlspecialchars($row['fruit']),
                htmlspecialchars($row['id']),
                htmlspecialchars($row['id'])
            ); // (updated) this code now also grabs the 'id' value from each array and used the <a> link to pass the 'id' value to the update.php page
               // the id=%s part in <a href="update.php?id=%s"> is how the $_GET on the update/delete pages gets set, with in this case id value.
        }

        mysqli_close($db);
     ?>
     <!-- the above code uses a foreach() function to grab the array in $result, loop over 
     it and on each iteration ($row) print out the following 'template' string containing passed 
     in values from database -->
     </ul>

     <!-- (update)
        The select.php page and update.php work together now. 
        1, when you click the 'edit' link on a line, you go to the update.php page.
        2, this page has the form used in the insert page.
        3, the form is now filled out with the 'person's chosen values that were sent to the database.
        4, Once altered and submitted, the persons values reflect the change.
     -->
     <!-- (update)
        the Delete link will take the client to the delete page thus deleting the chosen line/person/values
     -->

</body>
</html>