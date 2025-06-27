<?php

class BookingModel {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function createBooking($user_id, $showtime_id) {
        $query = $this->mysqli->prepare("INSERT INTO bookings (user_id, showtime_id) VALUES (?, ?)");
        $query->bind_param("ii", $user_id, $showtime_id);
        $query->execute();
        return $query->insert_id;
    }

    public function addSeatsToBooking($booking_id, $seatIds) {
        $query = $this->mysqli->prepare("INSERT INTO booking_seats (booking_id, seat_id) VALUES (?, ?)");
        foreach ($seatIds as $seatId) {
            $query->bind_param("ii", $booking_id, $seatId);
            $query->execute();
        }
    }
}
