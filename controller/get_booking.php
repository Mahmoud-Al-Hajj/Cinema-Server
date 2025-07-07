<?php
require '../connection/db.php';
require '../models/BookingModel.php';
header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(['error' => 'Please login']);
    exit;
}

$bookings = BookingModel::getBookingsByUser($mysqli, $user_id);
echo json_encode($bookings);
