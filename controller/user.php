<?php
require '../connection/db.php';
require '../models/UserModel.php';

header('Content-Type: application/json');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = UserModel::findByEmail($mysqli, $email);

    if ($user && password_verify($password, $user->password)) {
        echo json_encode([
            'success' => true,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'favorite_genres' => $user->favorite_genres,
            'role' => $user->role ?? 'user',    
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'not correct email & password',
        ]);
    }
    exit;
