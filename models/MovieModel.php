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


public function fetchFromDatabase($mysqli, $id) {
    $this->mysqli = $mysqli;
    $query = $mysqli->prepare("SELECT * FROM movies WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    if ($row = $result->fetch_assoc()) {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->release_date = $row['release_date'];
        $this->duration = $row['duration'];
        $this->genre = $row['genre'];
        $this->director = $row['director'];
        $this->created_at = $row['created_at'];
        $this->poster_url = $row['poster_url'];
    }

}

 public function addMovie($title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url) {
        $sql = "INSERT INTO movies (title, description, release_date, duration, genre, director, created_at, poster_url)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        return $stmt->execute([$title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url]);
    }

  
}