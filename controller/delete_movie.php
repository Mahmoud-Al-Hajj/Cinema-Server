<?php
header('Content-Type: application/json');
require '../connection/db.php';
require '../models/MovieModel.php';

$data = json_decode(file_get_contents("php://input"), true);
$movie_id = $data['movie_id'] ?? null;
$role = $data['role'] ?? 'user';

if ($role !== 'admin') {
    echo json_encode(['success' => false, 'message' => ' Admin only.']);
    exit;
}

$result = MovieModel::delete($mysqli, $movie_id);
if ($result) {
    echo json_encode(['success' => true, 'message' => 'Movie deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete movie']);
}
