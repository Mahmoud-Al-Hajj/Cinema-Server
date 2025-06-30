<?php
require '../connection/db.php';
require '../models/UserModel.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = new UserModel($mysqli);
    $userData = $userModel->findByEmail($mysqli, $email);

    if ($userData && password_verify($password, $userData['password'])) {
        echo json_encode([
            'success' => true,
            'user_id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'phone' => $userData['phone'],
            'favorite_genres' => $userData['favorite_genres'],
            'role' => $userData['role'] ?? 'user',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'not correct email or password',
        ]);
    }
    exit;
}