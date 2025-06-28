<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/BookingModel.php';

$user_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$user_id) {
    echo json_encode(['error' => 'User ID not specified']);
    exit;
}

$bookingModel = new BookingModel($mysqli);
$bookings = $bookingModel->getBookingsByUser($user_id);

echo json_encode($bookings);
