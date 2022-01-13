<?php
/** @var mysqli $db */

//Require music data & image helpers to use variable in this file
require_once "reservations/database.php";

if (isset($_POST['submit'])) {

    // Get the record from the database result
    $userId = mysqli_escape_string($db, $_POST['id']);
    $query = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

    $user = mysqli_fetch_assoc($result);

    // DELETE DATA
    // Remove the user data from the database with the existing albumId
    $query = "DELETE FROM users WHERE id = '$userId'";
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to homepage after deletion & exit script
    header("Location: index.php");
    exit;

} else if (isset($_GET['id']) || $_GET['id'] != '') {
    //Retrieve the GET parameter from the 'Super global'
    $userId = mysqli_escape_string($db, $_GET['id']);

    //Get the record from the database result
    $query = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // redirect when db returns no result
        header('Location: index.php');
        exit;
    }
} else {
    // Id was not present in the url OR the form was not submitted

    // redirect to index.php
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete - <?= $user['name'] ?></title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<h2>Delete - <?= $user['name'] ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u het album "<?= $user['name'] ?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
    <input type="submit" name="submit" value="Verwijderen"/>
</form>
</body>
</html>
