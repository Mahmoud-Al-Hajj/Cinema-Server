<?php
require '../connection/db.php';
require '../models/seatModel.php';
require '../models/bookingModel.php';

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'] ?? null;
$showtime_id = $data['showtime_id'];
$seat_ids = $data['seat_ids'];

$bookingModel = new BookingModel($mysqli);
$seatModel = new SeatModel($mysqli);

$booking_id = $bookingModel->createBooking($user_id, $showtime_id);
$bookingModel->addSeatsToBooking($booking_id, $seat_ids);
$seatModel->markSeatsBooked($seat_ids);

echo json_encode(['success' => true, 'booking_id' => $booking_id]);
