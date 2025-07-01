<?php

header('Content-Type: application/json');

require '../connection/db.php';
require '../models/MovieModel.php';

$movieModel = new MovieModel($mysqli);
$movie = $movieModel->getMovieById($_GET['id']);

 if (!$movie) {
    echo json_encode(['error' => 'Movie not found']);
    exit;
}
echo json_encode($movie);
