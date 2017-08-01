<?php
    require 'database.php';
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null == $id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="jumbotron">Read a Customer</h3>                   
            </div>
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-3">Name</label>
                    <div class="controls col-sm-9">
                        <label class="checkbox">
                            <?php echo $data['name'];?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Email Address</label>
                    <div class="controls col-sm-9">
                        <label class="checkbox">
                            <?php echo $data['email'];?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Mobile Number</label>
                    <div class="controls col-sm-9">
                        <label class="checkbox">
                            <?php echo $data['mobile'];?>
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <a class="btn" href="index.php">Back</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>