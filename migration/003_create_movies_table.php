<?php
require '../connection/db.php';

$query = "CREATE TABLE movies (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    release_date VARCHAR(250) NOT NULL,
    duration INT(11) ,
    genre VARCHAR(255) NOT NULL,
    director VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    poster_url VARCHAR(255) DEFAULT NULL
)";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created ";
}
