<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/SeatModel.php';

$showtime_id = $_GET['showtime_id'] ?? null;
if (!$showtime_id) {
    echo json_encode(['error' => 'No showtime_id provided']);
    exit;
}

$model = new SeatModel($mysqli);
echo json_encode($model->getSeatsByShowtime($showtime_id));
