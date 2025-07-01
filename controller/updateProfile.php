<?php
require '../connection/db.php';
require '../models/UserModel.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['user_id'])) {
    header("Location: /Frontend/Pages/profile.html");
    exit();
}

$id = $_POST['user_id'];
$data = $_POST;

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$favorite_genres = $data['favorite_genres'] ?? '';

$userModel = new UserModel($mysqli);
$success = $userModel->updateUser($id, $name, $email, $phone, $favorite_genres);

if ($success) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
}

?>
