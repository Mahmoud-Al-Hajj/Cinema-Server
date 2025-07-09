<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/SeatModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);
    $showtime_id = $data['showtime_id'] ?? null;
    $seat_row = $data['seat_row'] ?? null;
    $seat_number = $data['seat_number'] ?? null;

    $success = SeatModel::createSeat($mysqli, $showtime_id, $seat_row, $seat_number);
    echo json_encode(['success' => $success]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $showtime_id = $_GET['showtime_id'] ?? null;
    if (!$showtime_id) {
        echo json_encode(['error' => 'No showtime_id provided']);
        exit;
    }

    $seats = SeatModel::getSeatsByShowtime($mysqli, $showtime_id);
    echo json_encode($seats);
    exit;
}
