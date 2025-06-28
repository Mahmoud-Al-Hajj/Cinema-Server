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
        $_SESSION['user_name'] = $userData['name'];

        echo json_encode([
            'success' => true,
            'user_id' => $userData['id'],
            'user_name' => $userData['name'],
        ]);
    } else {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'not correct email or password',
        ]);


    }
    exit;
}