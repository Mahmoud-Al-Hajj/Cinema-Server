<?php
require '../connection/db.php';
require '../models/UserModel.php';
header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(['success' => false, 'message' => 'No user_id provided']);
    exit;
}

$user = UserModel::find($mysqli, $user_id);
if (!$user) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

echo json_encode([
    'success' => true,
    'user_id' => $user->id,
    'name' => $user->name,
    'email' => $user->email,
    'phone' => $user->phone,
    'favorite_genres' => $user->favorite_genres,
    'role' => $user->role ?? 'user'
]);
