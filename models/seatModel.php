<?php
require_once(__DIR__ . '/BaseModel.php');

class SeatModel extends Model {
    protected static string $table = 'seats';
    protected static string $primary_key = 'id';

    public int $id;
    public int $showtime_id;
    public string $seat_row;
    public int $seat_number;
    public bool $is_booked;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->showtime_id = $data['showtime_id'] ?? null;
        $this->seat_row = $data['seat_row'] ?? '';
        $this->seat_number = $data['seat_number'] ?? null;
        $this->is_booked = (bool)($data['is_booked'] ?? false);
    }

    public static function getSeatsByShowtime($mysqli, int $showtime_id) {
        $query = $mysqli->prepare("SELECT * FROM seats WHERE showtime_id = ?");
        $query->bind_param("i", $showtime_id);
        $query->execute();
        $result = $query->get_result();
        $seats = [];
        while ($row = $result->fetch_assoc()) {
            $seats[] = new static($row);
        }
        return $seats;
    }

    public static function markSeatsBooked($mysqli, array $seatIds) {
        $query = $mysqli->prepare("UPDATE seats SET is_booked = TRUE WHERE id = ?");
        foreach ($seatIds as $seatId) {
            $query->bind_param("i", $seatId);
            $query->execute();
        }
    }

    public static function createSeat($mysqli, $showtime_id, $seat_row, $seat_number) {
        $query = $mysqli->prepare("INSERT INTO seats (showtime_id, seat_row, seat_number, is_booked) VALUES (?, ?, ?, 0)");
        $query->bind_param("isi", $showtime_id, $seat_row, $seat_number);
        return $query->execute();
    }
}
