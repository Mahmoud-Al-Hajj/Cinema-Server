<?php
class SeatModel {
    protected static string $table = "seats";
    protected static string $primary_key = "id";

    private mysqli $mysqli;

    public function __construct( $mysqli = null) {

            $this->mysqli = $mysqli;
        }

    public function getSeatsByShowtime(int $showtime_id) {
        $query = $this->mysqli->prepare("SELECT * FROM seats WHERE showtime_id = ?");
        $query->bind_param("i", $showtime_id);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function markSeatsBooked(array $seatIds) {
        $query = $this->mysqli->prepare("UPDATE seats SET is_booked = TRUE WHERE id = ?");
        foreach ($seatIds as $seatId) {
            $query->bind_param("i", $seatId);
            $query->execute();
        }
    }

    public function createSeat($showtime_id, $seat_row, $seat_number) {
        $query = $this->mysqli->prepare("INSERT INTO seats (showtime_id, seat_row, seat_number, is_booked) VALUES (?, ?, ?, 0)");
        $query->bind_param("isi", $showtime_id, $seat_row, $seat_number);
        return $query->execute();
    }
}
