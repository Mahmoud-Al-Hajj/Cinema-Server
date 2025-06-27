<?php
session_start();
require '../connection/db.php';
require '../models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $userModel = new UserModel($mysqli);
    $userData = $userModel->findByEmail($mysqli,$email);

    if (password_verify($password, $userData['password'])) {

        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['name'];

        header("Location: /Frontend/Pages/movies.html");
        exit();
    } else {
header("Location: /Frontend/Pages/login.html");
            }
    exit;
}
?>
