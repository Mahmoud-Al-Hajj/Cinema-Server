<?php
require '../connection/db.php';

$query = "CREATE TABLE movies (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    release_date DATE NOT NULL,
    duration INT(11) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    director VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created successfully";
}
$execute->close();
$mysqli->close();   // cuz it saves resources.
?>