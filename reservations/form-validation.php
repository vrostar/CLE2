<?php
//Check if data is valid & generate error if not so
$errors = [];
if ($name == "") {
    $errors['name'] = 'Name cannot be empty';
}
if ($request == "") {
    $errors['request'] = 'Request cannot be empty';
}
if ($email == "") {
    $errors['email'] = 'Email cannot be empty';
}

if ($info == "") {
    $errors['info'] = 'Info cannot be empty';
}
// SERVER SIDE VALIDATION
