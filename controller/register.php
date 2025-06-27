<?php
session_start();
require '../connection/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $password = $_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



 $query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    
    if (mysqli_query($mysqli, $query)) {
        header("Location: /Frontend/Pages/login.html");
        
        exit();
    } else {
        header("Location: ../Frontend/Pages/login.html");
        exit();
    }
}
?>