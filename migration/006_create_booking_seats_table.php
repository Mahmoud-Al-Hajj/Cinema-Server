<?php
require '../connection/db.php';

$query = "CREATE TABLE booking_seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    seat_id INT
);";

$execute = $mysqli->prepare($query);
if ($execute->execute()) {
    echo "Table created ";
}
$execute->close();
$mysqli->close();
?>