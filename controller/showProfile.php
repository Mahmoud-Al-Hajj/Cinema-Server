<?php
require '../connection/db.php';
require '../models/UserModel.php';
header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? $_POST['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(['success' => false, 'message' => 'No user_id provided']);
    exit;
}

$userModel = new UserModel($mysqli);
$user = $userModel->showUser($user_id);

if (!$user) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$role = isset($user['role']) ? $user['role'] : 'user';
echo json_encode([
    'success' => true,
    'user_id' => $user['id'],
    'name' => $user['name'],
    'email' => $user['email'],
    'phone' => $user['phone'],
    'favorite_genres' => $user['favorite_genres'],
    'role' => $role
]);
