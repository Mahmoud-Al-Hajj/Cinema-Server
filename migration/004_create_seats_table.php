<?php
require '../connection/db.php';

$query = "CREATE TABLE seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    showtime_id INT,
    seat_row VARCHAR(255),
    seat_number INT,
    is_booked BOOLEAN DEFAULT FALSE
)";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created ";
}
$execute->close();
$mysqli->close();   // cuz it saves resources.
?>