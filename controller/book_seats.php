<?php
require '../connection/db.php';
require '../models/seatModel.php';
require '../models/bookingModel.php';

$data = json_decode(file_get_contents('php://input'), true);
//saw this on stack overflow, that if we are using $_POST it said:
//question was:How to get body of a JSON POST in PHP?
//answer was: to receive json data, we need to use this.


$user_id = $data['user_id'] ?? null;
$showtime_id = $data['showtime_id'];
$seat_ids = $data['seat_ids'];

$booking_id = BookingModel::createBooking($mysqli, $user_id, $showtime_id);
BookingModel::addSeatsToBooking($mysqli, $booking_id, $seat_ids);
BookingModel::markSeatsBooked($mysqli, $seat_ids);

echo json_encode(['success' => true, 'booking_id' => $booking_id]);
