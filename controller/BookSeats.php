<?php
session_start();
require '../connection/db.php';
require '../models/seatModel.php';
require '../models/bookingModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$user_id = $_SESSION['user_id'] ?? null;
$showtime_id = $_POST['showtime_id'] ?? null;
$seat_ids = $_POST['seat_ids'] ?? [];

if (!$user_id || !$showtime_id || empty($seat_ids)) {
    echo json_encode(['success' => false, 'message' => 'Missing data']);
    exit;
}

$bookingModel = new BookingModel($mysqli);
$seatModel = new SeatModel($mysqli);

$booking_id = $bookingModel->createBooking($user_id, $showtime_id);
$bookingModel->addSeatsToBooking($booking_id, $seat_ids);
$seatModel->markSeatsBooked($seat_ids);

