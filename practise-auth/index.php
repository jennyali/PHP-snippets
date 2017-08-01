<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="container">
        <div class="row jumbotron">
            <h2>Random Game score Board</h2>
            <h3 class="small">PHP Practising Auth and Security</h3>
        </div>
        <div class="row">
            <p>
                <a href="create.php" class="btn btn-success">Add Score</a>
            </p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM scores WHERE approved = 1 ORDER BY score DESC';
                        foreach($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'.$row['name'].'</td>';
                            echo '<td>'.$row['score'].'</td>';
                            echo '<td>'.$row['date'].'</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>