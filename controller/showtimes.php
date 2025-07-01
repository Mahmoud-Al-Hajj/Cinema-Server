<?php
header('Content-Type: application/json');

require '../connection/db.php';
require '../models/ShowtimeModel.php';

$movie_id = $_GET['movie_id'] ?? null;

if (!$movie_id) {
    echo json_encode(['error' => 'No movie_id provided']);
    exit;
}

$showtimeModel = new ShowtimeModel($mysqli);
$showtimes = $showtimeModel->getShowtimesByMovie($movie_id);

echo json_encode($showtimes);
