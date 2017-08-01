<?php 
    require 'database.php';

    if(!empty($_POST)) {
        
        $nameError = null;
        $scoreError = null;

        $name = $_POST['name'];
        $score = $_POST['score'];

        /*  SECURITY

            mysqli_real_escape_string needs a mysqli way of connecting to a Database not PDO method I keep using

            $name = mysqli_real_escape_string(Database::connect(), trim($_POST['name']));
            $score = mysqli_real_escape_string(Database::connect(), trim($_POST['score']));

        */

        $valid = true;

        if (empty($name)) {
            $nameError = 'Please enter a Name.';
            $valid = false;
        }

        if (empty($score)) {
            $scoreError = 'Please enter a Score.';
            $valid = false;
        }

        if($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO scores (name,score,date) values(?,?,NOW())";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$score));
            Database::disconnect();

            header("Location: index.php");
        }
    }
?>


<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3 class="jumbotron">Add a Score</h3>
        </div>

        <form class="form-group" action="create.php" method="post">

            <label for="name">Name:</label>
            <input type="text" name="name"/>
            <?php if (!empty($nameError)): ?>
                <span><?php echo $nameError; ?></span>
            <?php endif; ?>

            </br>

            <label for="score">Score:</label>
            <input type="number" name="score"/>
            <?php if (!empty($scoreError)): ?>
                <span><?php echo $scoreError; ?></span>
            <?php endif; ?>

            </br>

            <button type="submit" name="submit">Submit</button>

        </form>
        <div>
            <a href="index.php"><< Back</a>
        </div>
    </div>
</body>

</html>