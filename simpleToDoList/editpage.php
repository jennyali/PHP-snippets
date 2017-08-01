<?php 
    if(isset($_GET['id'])){
        $id = $_GET["id"];
    }
?>

<!DOCTYPE>
<html>
<head>
    <title>simpleToDoList</title>

    <link href="https://file.myfontastic.com/ncjQH3qL3iqtxPyrLNBQDo/icons.css" rel="stylesheet">
</head>

<body>
    <h3>My To Do List</h3>
    <h4>Edit page</h4>

    <a href="index.php">Back</a>

    <div>
        <?php include 'update.php';?>
    </div>
</body>
</html>