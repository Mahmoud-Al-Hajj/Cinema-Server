<?php
require '../connection/db.php';
require '../models/BookingModel.php';
header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? $_POST['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized - Please login']);
    exit;
}

$bookingModel = new BookingModel($mysqli);
$bookings = $bookingModel->getBookingsByUser($user_id);

echo json_encode($bookings);
