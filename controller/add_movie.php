<?php
require '../connection/db.php';
require '../models/MovieModel.php';

$data = json_decode(file_get_contents('php://input'), true);

$title = $data['title'] ?? '';
$genre = $data['genre'] ?? '';
$duration = $data['duration'] ?? '';
$release_date = $data['release_date'] ?? '';
$description = $data['description'] ?? '';
$director = $data['director'] ?? '';
$poster_url = $data['poster_url'] ?? '';
$created_at = date('Y-m-d H:i:s');

if ($title && $description && $release_date && $duration && $genre && $director) {
    $result = MovieModel::addMovie($title, $description, $release_date, $duration, $genre, $director, $created_at, $poster_url);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Movie added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add movie']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}