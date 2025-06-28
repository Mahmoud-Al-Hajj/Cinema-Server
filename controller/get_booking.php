<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized - Please login']);
    exit;
}

require '../connection/db.php';
require '../models/BookingModel.php';

$user_id = $_SESSION['user_id'];

$bookingModel = new BookingModel($mysqli);
$bookings = $bookingModel->getBookingsByUser($user_id);

echo json_encode($bookings);
