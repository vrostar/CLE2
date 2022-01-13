<?php
//Require music data to use variable in this file
/** @var $db */
require_once "reservations/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

//Close connection
mysqli_close($db);

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
    <h1>Reservations</h1>
</header>
<section>
    <a href="create.php">Create new user</a>
<table>
    <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Request</th>
        <th>Info</th>
        <th>More</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['request'] ?></td>
            <td><?= $user['info'] ?></td>
            <td><a href="detail.php?id=<?= $user['id'] ?>">Details</a></td>
            <td><a href="delete.php?id=<?= $user['id'] ?>">Delete</a></td>
            <td><a href="edit.php?id=<?= $user['id'] ?>">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</section>
</body>
</html>
<footer>
    <p>&copy; FEEBLE</p>
</footer>
