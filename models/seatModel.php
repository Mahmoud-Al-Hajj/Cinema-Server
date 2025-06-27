<?php
class SeatModel {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getSeatsByShowtime($showtime_id) {
        $query = $this->mysqli->prepare("SELECT * FROM seats WHERE showtime_id = ? ORDER BY seat_number");
        $query->bind_param("i", $showtime_id);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function markSeatsBooked($seatIds) {
        $query = $this->mysqli->prepare("UPDATE seats SET is_booked = TRUE WHERE id = ?");
        foreach ($seatIds as $seatId) {
            $query->bind_param("i", $seatId);
            $query->execute();
        }
    }
}
