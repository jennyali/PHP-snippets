<?php 

 require 'auth.php';

// this php code says if it can't find an id from the database to redirect to another page(select.php page)'
    if (isset($_GET['id']) && ctype_digit($_GET['id'])){
        $id = $_GET['id'];
    } else {
        header('Location: select.php');
    }
?>

<!DOCTYPE>
<html>
<head>
    <title>PHP</title>
</head>
<body>
<?php 
        readfile('navigation.tmpl.html'); // this code loads the whole external HTML page called 'navigation.html'.
    // require() in php only takes the php from an external file.



    $db = mysqli_connect('localhost', 'root', '', 'php');
    $sql = "DELETE FROM users WHERE id=$id"; // this SQL code is for deleting data related to the provided $id
    mysqli_query($db, $sql);
    echo '<p>User deleted.</p>';
    mysqli_close($db);
?>
</body>
</html>