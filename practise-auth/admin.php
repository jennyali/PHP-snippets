<?php 

    require_once 'authorize.php';

?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="container">
        <div class="row jumbotron">
            <h2>Admin Dashboard</h2>
            <h3 class="small">PHP Practising Auth and Security</h3>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Score</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM scores ORDER BY score DESC';
                        foreach($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'.$row['name'].'</td>';
                            echo '<td>'.$row['score'].'</td>';
                            echo '<td>'.$row['date'].'</td>';
                            echo '<td><a href="remove.php?id='.$row['id'].'">Remove</a>';

                            if($row['approved'] == null) {
                                echo '</br><a href="approve.php?id='.$row['id'].'">Approve</a>';
                            }

                            echo '</td></tr>';
                        }
                        Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>