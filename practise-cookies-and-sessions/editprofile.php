<?php
    require 'login.php';

    if(isset($_SESSION['user_id'])) {
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <h3 class="jumbotron">EDIT PROFILE</h3>
            <a href="index.php">Back</a>
        </div>
    </div>


</body>

</html>

<?php } ?>