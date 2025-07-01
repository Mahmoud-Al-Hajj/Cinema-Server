<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/MovieModel.php';

$movieModel = new MovieModel($mysqli);
$movies = $movieModel->getAllMovies();

echo json_encode($movies); 