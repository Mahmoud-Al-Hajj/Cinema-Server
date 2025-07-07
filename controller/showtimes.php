<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/ShowtimeModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $movie_id = $data['movie_id'] ?? null;
    $showtime = $data['showtime'] ?? null;
    $auditorium = $data['auditorium'] ?? null;
    if (!$movie_id || !$showtime || !$auditorium) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    $success = ShowtimeModel::createShowtime($mysqli, $movie_id, $showtime, $auditorium);
    echo json_encode(['success' => $success]);
    exit;
}

$movie_id = $_GET['movie_id'] ?? null;
if (!$movie_id) {
    echo json_encode(['error' => 'No movie_id provided']);
    exit;
}

$showtimes = ShowtimeModel::getShowtimesByMovie($mysqli, $movie_id);
$showtimes_array = array_map(fn($showtime) => [
    'id' => $showtime->id,
    'movie_id' => $showtime->movie_id,
    'showtime' => $showtime->showtime,
    'auditorium' => $showtime->auditorium
], $showtimes);
echo json_encode($showtimes_array);
