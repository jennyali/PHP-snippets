<?php 

    include 'connectionVar.php';

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname",
            $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $connection->prepare("SELECT id, task FROM simpletodo");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                    

            } catch(PDOException $e){
                echo $sql."<br>".$e->getMessage();
            }

            foreach ($stmt as $row) {
                printf(
                    '<li style="margin-bottom: 10px;">
                        <a href="editpage.php?id=%s" style="text-decoration: none; color: dimgrey;">%s</a>
                        <a href="delete.php?id=%s" style="text-decoration: none; margin-left: 20px; color: green;">
                            <span class="icon-check"></span>
                        </a>
                    </li>',
                    htmlspecialchars($row['id']),
                    htmlspecialchars($row['task']),
                    htmlspecialchars($row['id'])
                );
            }

    $connection = null;
?>