<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
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
        $query = "INSERT INTO users (name, request, email, info)
                  VALUES ('$name', '$request', '$email', '$info')";
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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="https://freight.cargo.site/w/1000/i/342d3ecd769707cc69f3765beaeaddd06e772fe37d9d934f849e071e1889e817/feeble-basic-logo.png" />
    <title>Reservations</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
    <img src="images/feeble1.png">
     <h1>Make a Request!</h1>
</header>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
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
    <a href="login/login.php">login</a>
</div>
</body>
</html>
<footer>
    <p>&copy; FEEBLE</p>
</footer>
