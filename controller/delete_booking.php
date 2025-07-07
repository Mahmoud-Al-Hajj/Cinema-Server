<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/BookingModel.php';

$data = json_decode(file_get_contents("php://input"), true);
$booking_id = $data['booking_id'] ?? null;
$user_id = $data['user_id'] ?? null;

$result = BookingModel::delete($mysqli, $booking_id);

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => 'Booking deleted successfully',
        'booking_id' => $booking_id
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to delete booking. It may not exist or an error occurred.',
        'booking_id' => $booking_id,
        'mysql_error' => $mysqli->error
    ]);
}
