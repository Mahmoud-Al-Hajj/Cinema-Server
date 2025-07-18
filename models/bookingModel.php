<?php
require_once(__DIR__ . '/BaseModel.php');

class BookingModel extends Model {
    protected static string $table = 'bookings';
    protected static string $primary_key = 'id';

    public int $id;
    public int $showtime_id;
    public int $user_id;
    public string $status;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->showtime_id = $data['showtime_id'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->status = $data['status'] ?? '';
    }

    public static function getBookingsByUser($mysqli, $user_id) {
        $query = $mysqli->prepare("
            SELECT
                b.id AS booking_id,
                b.showtime_id,
                b.status,
                s.auditorium,
                m.title AS movie_title,
                GROUP_CONCAT(CONCAT(se.seat_row, se.seat_number) ORDER BY se.seat_row,se.seat_number SEPARATOR ',') AS seats
            FROM bookings b
            JOIN showtimes s ON b.showtime_id = s.id
            JOIN movies m ON s.movie_id = m.id
            JOIN booking_seats bs ON b.id = bs.booking_id
            JOIN seats se ON bs.seat_id = se.id
            WHERE b.user_id = ?
            GROUP BY b.id
        ");
        $query->bind_param("i", $user_id);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getSeatIdsByBookings($mysqli, $booking_id) {
        $query = $mysqli->prepare("SELECT seat_id FROM booking_seats WHERE booking_id = ?");
        $query->bind_param("i", $booking_id);
        $query->execute();
        $result = $query->get_result();
        $seat_ids = [];
        while ($row = $result->fetch_assoc()) {
            $seat_ids[] = $row['seat_id'];
        }
        return $seat_ids;
    }

    public static function createBooking($mysqli, $user_id, $showtime_id) {
        $query = $mysqli->prepare("INSERT INTO bookings (user_id, showtime_id) VALUES (?, ?)");
        $query->bind_param("ii", $user_id, $showtime_id);
        $query->execute();
        return $query->insert_id;
    }

    public static function addSeatsToBooking($mysqli, $booking_id, $seat_ids) {
        foreach ($seat_ids as $id) {
            $stmt = $mysqli->prepare("INSERT INTO booking_seats (booking_id, seat_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $booking_id, $id);
            if (!$stmt->execute()) return false;
        }
        return true;
    }

    public static function markSeatsBooked($mysqli, $seat_ids) {
        foreach ($seat_ids as $id) {
            $stmt = $mysqli->prepare("UPDATE seats SET is_booked = 1 WHERE id = ?");
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                return false;
            }
        }
        return true;
    }

    public static function deleteBooking($mysqli, $id) {
        return parent::delete($mysqli, $id);
    }
}