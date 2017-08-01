
<?php 

include 'header.php'; 

require 'database.php';

if (!empty($_POST)) {
    

    // err msgs 
    $nameError = null;
    $typeError = null;
    $desciptionError = null;

    // inc Post values
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    $valid = true;

    if(empty($name)) {
        $nameError = "Please enter a name";
        $valid = false;
    }

    if(empty($type)) {
        $typeError = "Please select a type";
        $valid = false;
    }

    if(trim($_POST['description']) == "") {
        $descriptionError = "Please write a description";
        $valid = false;
    }

    if($valid) {


        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO animals (name,type,description) values(?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name,$type,$description));
        Database::disconnect();

        header("Location: index.php");
    }

};

?>

<section class="container">
    <div class="row">
        <h2 class="jumbotron">Register Animal</h2>
        <a href="index.php" class="btn btn-link">Back</a>
        <hr>
    </div>
    <div class="row">

        <form class="form-horizontal col-sm-9 panel panel-default <?php echo ($valid) ? '' : 'panel-danger' ?>" action="register.php" method="POST">
            <div class="panel-body">

                <div class="form-group <?php echo !empty($nameError) ? 'has-error': '' ?>">
                    <label class="control-label col-sm-3" for="name">Name:</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="name" value="<?php echo !empty($_POST['name']) ? $_POST['name'] : '' ?>"/>
                        <?php if(!empty($nameError)): ?>
                            <span class="help-inline">
                                <?php echo $nameError; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="form-group <?php echo !empty($typeError) ? 'has-error': '' ?>">
                    <label class="control-label col-sm-3" for="type">Type:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type">
                            <option value="">Choose an option...</option>
                            <option value="mammal">Mammal</option>
                            <option value="bird">Bird</option>
                            <option value="fish">Fish</option>
                        </select>
                        <?php if(!empty($typeError)): ?>
                            <span class="help-inline">
                                <?php echo $typeError; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="form-group <?php echo !empty($descriptionError) ? 'has-error': '' ?>">
                    <label class="control-label col-sm-3" for="description">Description:</label>
                    <div class="col-sm-9">
                        <textarea style="width:100%" name="description" rows="10"><?php echo !empty($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                        <?php if(!empty($descriptionError)): ?>
                            <span class="help-inline">
                                <?php echo $descriptionError; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Submit</button>

            </div>
        </form>

    </div>

</section>

<?php include 'footer.php' ?>