<?php

    require 'database.php';

    define('MY_UPLOADPATH', 'images/');

    //CREATE

    if (isset($_POST['submit'])) {

        $name= $_POST['name'];
        $image= $_FILES['image']['name'];

        //errors
        $nameError = null;
        $imageError = null;

        $valid = true;

        $target = MY_UPLOADPATH.$image;
        ;



        if(empty($name)) {
            $nameError = 'Please enter a Name';
            $valid = false;
        }


        if($valid) {
        
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $dbc = mysqli_connect('localhost', 'root', '', 'projectone');

                $query = "INSERT INTO pictures VALUES (0, NOW(), '$name', '$image')";
                mysqli_query($dbc, $query);

                mysqli_close($dbc);

                //header("Location: index.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload file V2.0</title>
</head>
<body>

    <h2> My Upload form </h2>

    <hr>

    <form enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <input type="hidden" name="MAX_FILE_SIZE" value="32768" /> <!-- establishes max file size for uploads -->

        <label for="name">Name: </label>
        <input type="text" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
        <span><?php if(!empty($nameError)) echo $nameError; ?></span>

        </br>

        <label for="image">Image: </label>
        <input type="file" name="image"/>

        
        </br>

        <hr>

        <button type="submit" name="submit" >Submit</button>

    </form>

    <div style="margin-top:50px">

        <?php //READ
        
            $pdo = Database::connect();
            $sql = "SELECT * FROM pictures ORDER BY id DESC";
            foreach($pdo->query($sql) as $row) {

                echo '<div style="margin:15px 0px">';

                if (is_file(MY_UPLOADPATH . $row['image']) && filesize(MY_UPLOADPATH . $row['image']) > 0) {
                    echo '<img src="'.MY_UPLOADPATH.$row['image'].'">';
                } else {
                    echo '<img src="'.MY_UPLOADPATH.'placeholder.png'.'">';
                }
                
                echo '<p>'.$row['date'].'</p>';
                echo '<p>'.$row['name'].'</p>';
                echo '</div';

            }
            Database::disconnect();

        ?>

    </div>




</body>
</html>