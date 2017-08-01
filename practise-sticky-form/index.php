
<?php include 'header.php'; ?>



<section class="container">
    <div class="row">
        <h2 class="jumbotron">My Zoo</h2>
        <a href="register.php" class="btn btn-primary">Register an Animal!</a>
        <hr>
    </div>
    <div class="row">
        <p>Current Animals</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'database.php';
                    $pdo = Database::connect();
                    $sql = 'SELECT * FROM animals ORDER BY id DESC';
                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>'.$row['name'].'</td>';
                        echo '<td>'.$row['type'].'</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                ?>

            </tbody>
        </table>
    </div>
</section>



<?php include "footer.php"; ?>


