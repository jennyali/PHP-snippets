

<?php include 'insert.php'; ?>

<!DOCTYPE>
<html>
<head>
    <title>simpleToDoList</title>

    <link href="https://file.myfontastic.com/ncjQH3qL3iqtxPyrLNBQDo/icons.css" rel="stylesheet">

</head>

<body>
    <h3>My To Do List</h3>
    <div>
        <form action="index.php" method="post">
            <input type="type" name="task">
            <input type="submit" name="submit" value="Submit">
        </form>

        <p style="color:red;">
            <?php echo $errMsg; ?>
        </p>
    </div>
    <div>
        <p>Current tasks:</p></br>
        <ul>
            <?php include 'select.php'; ?>
        </ul>
    </div>
</body>
</html>