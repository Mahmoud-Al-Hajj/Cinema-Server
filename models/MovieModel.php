<?php
require_once(__DIR__ . '/BaseModel.php');
require_once('../connection/db.php');

class MovieModel extends Model {
    protected static string $table = 'movies';
    protected static string $primary_key = 'id';

    public int $id;
    public string $title;
    public string $description;
    public string $release_date;
    public int $duration;
    public string $genre;
    public string $director;
    public string $created_at;
    public string $poster_url;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->release_date = $data['release_date'] ?? '';
        $this->duration = $data['duration'] ?? 0;
        $this->genre = $data['genre'] ?? '';
        $this->director = $data['director'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->poster_url = $data['poster_url'] ?? '';
    }

    public static function movieExists($title) {
        global $mysqli;
        $sql = sprintf("SELECT %s FROM (SELECT * FROM " . static::$table . ") AS subquery WHERE title = ?", static::$primary_key);
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $title);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public static function addMovie($title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url) {
        global $mysqli;
    $sql = sprintf("INSERT INTO %s (title, description, release_date, duration, genre, director, created_at, poster_url) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)",static::$table);
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssisss", $title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url);
        return $stmt->execute();
    }

    public static function all($mysqli) {
        $sql = "SELECT * FROM " . static::$table;
        $result = $mysqli->query($sql);
        $movies = [];
        while ($row = $result->fetch_assoc()) {
            $movies[] = new static($row);
        }
        return $movies;
    }

    public static function find($mysqli, $id) {
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$primary_key . " = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0 ? new static($result->fetch_assoc()) : null;
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'duration' => $this->duration,
            'genre' => $this->genre,
            'director' => $this->director,
            'created_at' => $this->created_at,
            'poster_url' => $this->poster_url
        ];
    }
    public static function delete($mysqli, $id) {
        return parent::delete($mysqli, $id);
    }
}
