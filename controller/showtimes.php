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
    $showtimeModel = new ShowtimeModel($mysqli);
    $success = $showtimeModel->createShowtime($movie_id, $showtime, $auditorium);
    echo json_encode(['success' => $success]);
    exit;
}

$movie_id = $_GET['movie_id'] ?? null;

if (!$movie_id) {
    echo json_encode(['error' => 'No movie_id provided']);
    exit;
}

$showtimeModel = new ShowtimeModel($mysqli);
$showtimes = $showtimeModel->getShowtimesByMovie($movie_id);

echo json_encode($showtimes);
