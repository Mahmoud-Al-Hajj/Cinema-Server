<?php
require '../connection/db.php';

$auditoriums = ['A', 'B', 'C'];
$now = new DateTime();

$result = $mysqli->query("SELECT id FROM movies");
while ($movie = $result->fetch_assoc()) {
    $movie_id = $movie['id'];

for ($i = 0; $i < 3; $i++) {
    $auditorium = $auditoriums[array_rand($auditoriums)];
    $datetime = (new DateTime("+$i day"))->setTime(18 + $i, 0)->format('Y-m-d H:i:s');

    $stmt = $mysqli->prepare("INSERT INTO showtimes (movie_id, showtime, auditorium) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $movie_id, $datetime, $auditorium);
    $stmt->execute();
}

}

echo "Showtimes seeded successfully!";
