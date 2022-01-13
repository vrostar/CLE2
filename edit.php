<?php
/** @var mysqli $db */

$userId = $_GET['id'];
//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {

    require_once "reservations/database.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name   = mysqli_escape_string($db, $_POST['name']);
    $request = mysqli_escape_string($db, $_POST['request']);
    $email  = mysqli_escape_string($db, $_POST['email']);
    $info  = mysqli_escape_string($db, $_POST['info']);

    //Require the form validation handling
    require_once "reservations/form-validation.php";


    if (empty($errors)) {
        //Save the record to the database
        $query = "UPDATE users SET name='$name',request='$request',email='$email',info='$info' WHERE id='$userId'";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<header>
    <img src="images/feeble1.png">
<h1>Edit</h1>
</header>
<section>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="data-field">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : '' ?>"/>
            <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="request">Request</label>
            <input id="request" type="text" name="request" value="<?= isset($request) ? htmlentities($request) : '' ?>"/>
            <span class="errors"><?= isset($errors['request']) ? $errors['request'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
            <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
        </div>
        <div class="data-field">
            <label for="info">Info</label>
            <input id="info" type="text" name="info" value="<?= isset($info) ? htmlentities($info) : '' ?>"/>
            <span class="errors"><?= isset($errors['info']) ? $errors['info'] : '' ?></span>
        </div>
        <div class="data-submit">
            <input type="submit" name="submit" value="Save"/>
        </div>
    </form>
</section>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
<footer>
    <p>&copy; FEEBLE</p>
</footer>
