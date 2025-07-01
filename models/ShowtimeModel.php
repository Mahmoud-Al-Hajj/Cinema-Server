<?php
require ('../connection/db.php');

class ShowtimeModel {
    private $mysqli;

    public function __construct(mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

public function getShowtimesByMovie($movie_id) {
    $query = $this->mysqli->prepare("SELECT * FROM showtimes WHERE movie_id = ?");
    $query->bind_param("i", $movie_id);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

}
