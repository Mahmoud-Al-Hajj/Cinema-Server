<?php
require '../connection/db.php';

$query = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    showtime_id INT,
    booking_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'confirmed')
    ";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created ";
}
$execute->close();
$mysqli->close();
?>