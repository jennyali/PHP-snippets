<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://file.myfontastic.com/ncjQH3qL3iqtxPyrLNBQDo/icons.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <h3 class="jumbotron">GROOVY FANCLUB</h3>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?php
                    // Set menu depending on logged in or not. 
                    if(isset($_COOKIE['username'])) {

                        echo '<a href="viewprofile.php">View Profile</a></br>';
                        echo '<a href="editprofile.php">Edit Profile</a></br>';
                        echo '<a href="logout.php">Log Out (' . $_COOKIE['username'] . ')</a>';
                    } else {

                        echo '<a href="login.php">Log In</a></br>';
                        echo '<a href="signup.php">Sign Up</a></br>';
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3>Latest Members:</h3>
            </div>
            <div class="col-sm-12">
                <ul class="list-unstyled">
                    <?php 

                        require_once 'database.php';
                    
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM fanclub ORDER BY join_date DESC';
                        foreach( $pdo->query($sql) as $row) {

                            echo '<li class="icon-user-2"> ' . $row['username'] . '</li>';
                        }
                        Database::disconnect();

                    ?>
                </ul>     
            </div>
        </div>
    </div>


</body>

</html>