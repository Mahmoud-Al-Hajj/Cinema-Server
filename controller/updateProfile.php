<?php
session_start();
require '../connection/db.php';
require '../models/UserModel.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['user_id'])) {
    header("Location: /Frontend/Pages/profile.html");
    exit();
}

$id = $_SESSION['user_id'];
$data = $_POST;


$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$favorite_genres = $data['favorite_genres'] ?? '';

$userModel = new UserModel($mysqli);
$success = $userModel->updateUser($id, $name, $email,$phone ,$favorite_genres);

?>
