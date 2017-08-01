<?php
    // insert database//

    $task = '';
    $errMsg = '';
    $successMsg = '';

    if (isset($_POST['submit'])) {
        $ok = true;

        if(!isset($_POST['task']) || $_POST['task'] === '') {
            $ok = false;
            $errMsg = "ERROR! : No task submitted";

        } else {
            $task = $_POST['task'];
        }

        if($ok) {

            include 'connectionVar.php';

            try {
                $connection = new PDO("mysql:host=$servername;dbname=$dbname",
                $username, $password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO simpletodo (task) VALUES ('$task')";
                $connection->exec($sql);

                header("Location: index.php");
            
            } catch(PDOException $e){
                echo $sql."<br>".$e->getMessage();
            }
        }
    }
 
    $connection = null;
?>