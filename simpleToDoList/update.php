
<?php

    $task = '';
    $currentId = '';

    if (isset($_POST['submit'])) {
        $ok = true;
        
        if(!isset($_POST['task']) || $_POST['task'] === '') {
            $ok = false;
            //$errMsg = "ERROR! : No task submitted";

        } else {
            $task = $_POST['task'];
            $currentId = $_POST['id'];
        }

        printf($task);
        printf($currentId);

        if($ok) {

            include 'connectionVar.php';

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE simpletodo SET task='$task' WHERE id=$currentId";
                $conn->exec($sql);

                header("Location: index.php");
            
            } catch(PDOException $e){
                echo $sql."<br>".$e->getMessage();
            }
        }
        
    } else {
        
        include 'connectionVar.php';

            try { 
                $connection = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $connection->prepare("SELECT id, task FROM simpletodo WHERE id = :id");
                $stmt->execute(array(':id' => "$id"));
                $row = $stmt->fetch();

                printf('
                        <div>
                            <ul>
                                <li> %s </li>
                            </ul>
                        </div>
                        <div>
                            <form method="post" action="update.php">
                                <input type="text" name="task">
                                <input type="hidden" name="id" value="%s">
                                <input type="submit" name="submit" value="Edit">
                            </form>
                        </div>
                    ',
                    $row["task"],
                    $row["id"]
                );
    
                } catch(PDOException $e){
                    echo $sql."<br>".$e->getMessage();
                }
    }

    $connection = null;
?>
