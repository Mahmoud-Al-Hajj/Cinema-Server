<?php
require '../connection/db.php'; // adjust path as needed

$jsonFile = 'C:/Users/user/Desktop/SE Factory/Cinema Booking Platform/Frontend/assets/movies40.JSON';
$jsonData = file_get_contents($jsonFile);
$decoded = json_decode($jsonData, true);

if (!isset($decoded['movies'])) {
    die("Invalid JSON structure: 'movies' key not found.");
}

$movies = $decoded['movies'];

$query = $mysqli->prepare("INSERT INTO movies
    (title, description, release_date, duration, genre, director, poster_url)
    VALUES (?, ?, ?, ?, ?, ?, ?)");

foreach ($movies as $movie) {
    $title = $movie['title'];
    $description = $movie['plot'];
    $release_date = $movie['year']; // You may want to convert to full date format if needed
    $duration = $movie['runtime'];
    $genre = implode(', ', $movie['genres']); // Convert array to string
    $director = $movie['director'];
    $poster = $movie['posterUrl'];

    $query->bind_param("sssssss", $title, $description, $release_date, $duration, $genre, $director, $poster);
    $query->execute();
}

echo "Movies imported successfully!";
?>
