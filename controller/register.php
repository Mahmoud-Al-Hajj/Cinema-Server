<?php
require '../connection/db.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, phone, password, role) VALUES ('$name', '$email', '$phone', '$password', 'user')";
    $result = mysqli_query($mysqli, $query);
    $result = mysqli_affected_rows($mysqli);
    
        header("Location: /Frontend/Pages/login.html");
        exit();

?>