<?php

class BookingModel {
    private $mysqli;
        protected static string $table = 'bookings';
    protected static string $primary_key = 'id';

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }
public function getBookingsByUser($user_id) {
    $query = $this->mysqli->prepare("SELECT * FROM bookings WHERE user_id = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


    public function createBooking($user_id, $showtime_id) {
        $query = $this->mysqli->prepare("INSERT INTO bookings (user_id, showtime_id) VALUES (?, ?)");
        $query->bind_param("ii", $user_id, $showtime_id);
        $query->execute();
        return $query->insert_id;
    }

    public function addSeatsToBooking($booking_id, $seat_ids) {
    foreach ($seat_ids as $id) {
        $stmt = $this->mysqli->prepare("INSERT INTO booking_seats (booking_id, seat_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $booking_id, $id);
        if (!$stmt->execute()) return false;
    }
    return true;
}
public function markSeatsBooked($seat_ids) {
    foreach ($seat_ids as $id) {
        $stmt = $this->mysqli->prepare("UPDATE seats SET is_booked = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            return false;
        }
    }
    return true;
}


}
