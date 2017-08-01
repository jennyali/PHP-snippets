<?php 
    $id = $_GET["id"];

    include 'connectionVar.php';

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname",
            $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM simpletodo WHERE id=$id";
            $connection->exec($sql);

            header("Location: index.php");

        } catch(PDOException $e){
            echo '<a href="index.php">Back</a><br>';
            echo $sql."<br>".$e->getMessage();
        }

    $connection = null;
?>
