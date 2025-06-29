<?php
session_start();
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/BookingModel.php';
require '../models/seatModel.php';

$data = json_decode(file_get_contents("php://input"), true);
$booking_id = $data['booking_id'] ?? null;

$bookingModel = new BookingModel($mysqli);
$seatModel = new SeatModel($mysqli);

$seat_ids = $bookingModel->getSeatIdsByBookings($booking_id);
$result = $bookingModel->deleteBooking($booking_id);

if ($result) {
    echo json_encode(['success' => true, 'message' => 'Booking deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete booking']);
}
