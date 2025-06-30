<?php
require '../connection/db.php';

$query = "
ALTER TABLE showtimes
ADD CONSTRAINT fk_showtimes_movie
FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE;

ALTER TABLE seats
ADD CONSTRAINT fk_seats_showtime
FOREIGN KEY (showtime_id) REFERENCES showtimes(id) ON DELETE CASCADE;

ALTER TABLE bookings
ADD CONSTRAINT fk_bookings_showtime
FOREIGN KEY (showtime_id) REFERENCES showtimes(id) ON DELETE CASCADE;

ALTER TABLE booking_seats
ADD CONSTRAINT fk_booking_seats_seat
FOREIGN KEY (seat_id) REFERENCES seats(id) ON DELETE CASCADE;
";

if ($mysqli->multi_query($query)) {
    echo "Foreign keys added successfully!";
} else {
    echo "Error adding foreign keys: " . $mysqli->error;
}

$mysqli->close();
?>
