<?php
require ('../connection/db.php');
class MovieModel {
    private $mysqli;
    private $id;
    private string $title;
    private string $description;
    private string $release_date;
    private int $duration;
    private string $genre;
    private string $director;
    private string $created_at;
    private string $poster_url;

public function __construct(mysqli $mysqli) {
    $this->mysqli = $mysqli;

}

    public function getAllMovies() {
        $query = "SELECT * FROM movies";
        $result = $this->mysqli->query($query);
        $movies = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $movies[] = $row;
            }
        }

        return $movies;
    }

 public function addMovie($title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url) {
        $sql = "INSERT INTO movies (title, description, release_date, duration, genre, director, created_at, poster_url)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        return $stmt->execute([$title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url]);
    }

    public function getMovieById($id) {
        $sql = "SELECT * FROM movies WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
  
}