<?php
require '../connection/db.php';
require '../models/UserModel.php';

header('Content-Type: application/json');

if (!isset($_POST['user_id'])) {
    header("Location: /Frontend/Pages/profile.html");
    exit();
}

$id = $_POST['user_id'];
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$favorite_genres = $_POST['favorite_genres'] ?? '';

$success = UserModel::updateUser($mysqli, $id, $name, $email, $phone, $favorite_genres);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
}

?>
