<?php

header('Content-Type: application/json');

require '../connection/db.php';
require '../models/MovieModel.php';

    $movies = MovieModel::all($mysqli);
    echo json_encode($movies);
    exit;

