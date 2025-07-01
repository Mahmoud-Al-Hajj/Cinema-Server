<?php
require '../connection/db.php';

$query = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    favorite_genres TEXT
    role VARCHAR(20) NOT NULL DEFAULT 'user'
);";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created ";
}
$execute->close();
$mysqli->close();
?>