<?php
require ('../connection/db.php');
require_once(__DIR__ . '/BaseModel.php');

class ShowtimeModel extends Model {
    protected static string $table = 'showtimes';
    protected static string $primary_key = 'id';

    public int $id;
    public int $movie_id;
    public string $showtime;
    public string $auditorium;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->movie_id = $data['movie_id'] ?? null;
        $this->showtime = $data['showtime'] ?? '';
        $this->auditorium = $data['auditorium'] ?? '';
    }

    public static function getShowtimesByMovie($mysqli, $movie_id) {
        $query = $mysqli->prepare("SELECT * FROM showtimes WHERE movie_id = ?");
        $query->bind_param("i", $movie_id);
        $query->execute();
        $result = $query->get_result();
        $showtimes = [];
        while ($row = $result->fetch_assoc()) {
            $showtimes[] = new static($row);
        }
        return $showtimes;
    }

    public static function createShowtime($mysqli, $movie_id, $showtime, $auditorium) {
        $query = $mysqli->prepare("INSERT INTO showtimes (movie_id, showtime, auditorium) VALUES (?, ?, ?)");
        $query->bind_param("iss", $movie_id, $showtime, $auditorium);
        return $query->execute();
    }
}
