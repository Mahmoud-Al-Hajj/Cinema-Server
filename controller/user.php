<?php
session_start();
require '../connection/db.php';
require '../models/UserModel.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = new UserModel($mysqli);
    $userData = $userModel->findByEmail($mysqli, $email);

    if ($userData && password_verify($password, $userData['password'])) {
        $_SESSION['user_id'] = $userData['id'];

        echo json_encode([
            'success' => true,
            'user_id' => $userData['id'],
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'not correct email or password',
        ]);


    }
    exit;
}