<?php
require '../connection/db.php';
require '../models/MovieModel.php';

$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'] ?? '';
$genre = $data['genre'] ?? '';
$duration = $data['duration'] ?? '';
$release_date = $data['release_date'] ?? '';
$rating = $data['rating'] ?? '';
$description = $data['description'] ?? '';
$director = $data['director'] ?? '';
$poster_url = $data['poster_url'] ?? '';
$created_at = date('Y-m-d H:i:s');
$movieModel = new MovieModel($mysqli);

if ($movieModel->addMovie($title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url)) {
    echo json_encode(['success' => true, 'message' => 'Movie added successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add movie']);
}