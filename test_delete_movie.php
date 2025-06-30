<?php
// Test script to verify delete movie functionality
require 'connection/db.php';
require 'models/MovieModel.php';

echo "Testing delete movie functionality...\n";

// Create a test movie
$movieModel = new MovieModel($mysqli);

// First, let's see what movies exist
$movies = $movieModel->getAllMovies();
echo "Current movies in database:\n";
foreach ($movies as $movie) {
    echo "- ID: {$movie['id']}, Title: {$movie['title']}\n";
}

if (empty($movies)) {
    echo "No movies found. Please add some movies first.\n";
    exit;
}

// Test with the first movie
$testMovie = $movies[0];
echo "\nTesting delete for movie: {$testMovie['title']} (ID: {$testMovie['id']})\n";

// Check if movie exists before deletion
$movieExists = $movieModel->getMovieById($testMovie['id']);
if ($movieExists) {
    echo "Movie exists before deletion.\n";
    
    // Try to delete the movie
    $result = $movieModel->deleteMovie($testMovie['id']);
    
    if ($result) {
        echo "SUCCESS: Movie deleted successfully!\n";
        
        // Verify deletion
        $movieAfterDelete = $movieModel->getMovieById($testMovie['id']);
        if (!$movieAfterDelete) {
            echo "VERIFICATION: Movie no longer exists in database.\n";
        } else {
            echo "WARNING: Movie still exists after deletion.\n";
        }
    } else {
        echo "ERROR: Failed to delete movie.\n";
        echo "MySQL Error: " . $mysqli->error . "\n";
    }
} else {
    echo "ERROR: Movie not found before deletion.\n";
}

$mysqli->close();
?> 