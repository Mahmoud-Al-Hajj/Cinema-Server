<?php
require '../connection/db.php';
require '../models/MovieModel.php';

// Load n decode JSON file
$jsonFile = 'C:/Users/user/Desktop/SE Factory/Cinema Booking Platform/Frontend/assets/movies40.JSON';
$jsonData = file_get_contents($jsonFile);
$decoded = json_decode($jsonData, true);


$movies = $decoded['movies'];
//$moviesModel = new MovieModel($mysqli); this was before extending the BaseModel


foreach ($movies as $movie) {
    $title = $movie['title'];
    $description = $movie['plot'];
    $release_date = $movie['year'];
    $duration = $movie['runtime'];
    $genre = implode(', ', $movie['genres']);
    $director = $movie['director'];
    $created_at = date('Y-m-d H:i:s');
    $poster = $movie['posterUrl'];

        if ($moviesModel->movieExists($title)) {
        echo "Skipped duplicate: $title";
        continue;
    }
    $query = $moviesModel->addMovie(
        $title,
        $description,
        $release_date,
        $duration,
        $genre,
        $director,
        $created_at,
        $poster
    );

    if (!$query) {
        echo "Failed to insert movie: $title\n";
    }
}
