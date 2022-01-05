<?php
//Require database in this file
/** @var $db */
require_once "reservations/database.php";

//If the ID isn't given, redirect to the homepage
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: index.php');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$userId = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM users WHERE id = " . $userId;
$result = mysqli_query($db, $query);

//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

//Transform the row in the DB table to a PHP array
$user = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details - <?= $user['name'] ?></title>
</head>
<body>
<h2><?= $user['name'] . ' - ' . $user['request'] ?></h2>

<ul>
    <li>EMAIL: <?= $user['email'] ?></li>
    <li>VERZOEK: <?= $user['request'] ?></li>
    <li>INFO: <?= $user['info'] ?></li>
</ul>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
