<?php
require '../connection/db.php';

$query = "CREATE TABLE showtimes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT ,
    showtime DATETIME,
    auditorium VARCHAR(250)
);
";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created ";
}
