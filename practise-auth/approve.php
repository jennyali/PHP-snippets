
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
            <h2>Approve Score</h2>
            <h3 class="small">PHP Practising Auth and Security</h3>
        </div>
        <div class="row">

            <?php 

                require_once 'database.php';

                //varibles
            
                $id = null;
                $name = null;
                $score = null;
                $date = null;

                // GET Request

                if(isset($_GET['id'])) {
                    $id = $_GET['id'];

                    
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM scores WHERE id = ?";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($id));
                        $data = $q->fetch(PDO::FETCH_ASSOC);

                        $name = $data['name'];
                        $score = $data['score'];
                        $date = $data['date'];

                        Database::disconnect();

                } else if (isset($_POST['id'])) {

                    // POST Request to get details from id.

                    $id = $_POST['id'];

                    
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM scores WHERE id = ?";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($id));
                        $data = $q->fetch(PDO::FETCH_ASSOC);

                        $name = $data['name'];
                        $score = $data['score'];
                        $date = $data['date'];

                        Database::disconnect();
                }

                if(isset($_POST['submit'])) {

                    // POST request to Delete.

                    $id = $_POST['id'];
                
                    if($_POST['confirm'] == 'yes') {

                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE scores SET approved = 1 WHERE  id = ?";
                        $q = $pdo->prepare($sql);
                        $q->execute(array($id));
                        Database::disconnect();

                        echo "<p style='color:green'>Score WAS approved</p>";

                    } else {
                        echo "<p style='color:red'>Score was NOT approved</p>";
                    }

                } else if (isset($id) && isset($name) && isset($score) && isset($date)) {

                    echo '<p> Are you sure you want to approve the following score?</p>';
                    echo '<p>'.$name.'</p></br>';
                    echo '<p>'.$score.'</p></br>';
                    echo '<p>'.$date.'</p></br>';
                    echo '<form method="POST" action="approve.php">';
                    echo '<input type="hidden" name="id" value="'.$id.'" />';
                    echo '<input type="radio" name="confirm" value="yes" />Yes';
                    echo '<input type="radio" name="confirm" value="no" checked="checked"/>No';
                    echo '<hr>';
                    echo '<button type="submit" name="submit">Submit</button>';
                    echo '</form>';
                }
            ?>

            <hr>

            <a href="admin.php"><< Back</a>

        </div>
        
    </div>

</body>

</html>