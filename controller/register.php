<?php
require '../connection/db.php';
require '../models/UserModel.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $user = userModel::createUser($mysqli, $name, $email, $phone, $password, '', 'user');

        header("Location: /Frontend/Pages/login.html");
        exit();

?>