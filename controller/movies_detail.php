<?php

header('Content-Type: application/json');

require '../connection/db.php';
require '../models/MovieModel.php';

$id = $_GET['id'] ?? null;
$movie = MovieModel::find($mysqli, $id);
echo json_encode($movie);
