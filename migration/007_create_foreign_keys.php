<?php
require '../connection/db.php';

$query = "
ALTER TABLE showtimes
ADD CONSTRAINT fk_showtimes_movie
FOREIGN KEY (movie_id) REFERENCES movies(id);

ALTER TABLE seats
ADD CONSTRAINT fk_seats_showtime
FOREIGN KEY (showtime_id) REFERENCES showtimes(id);

ALTER TABLE bookings
ADD CONSTRAINT fk_bookings_user
FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE bookings
ADD CONSTRAINT fk_bookings_showtime
FOREIGN KEY (showtime_id) REFERENCES showtimes(id);

ALTER TABLE booking_seats
ADD CONSTRAINT fk_booking_seats_booking
FOREIGN KEY (booking_id) REFERENCES bookings(id);

ALTER TABLE booking_seats
ADD CONSTRAINT fk_booking_seats_seat
FOREIGN KEY (seat_id) REFERENCES seats(id);
";

if ($mysqli->multi_query($query)) {
    echo "Foreign keys added successfully!";
} else {
    echo "Error adding foreign keys: " . $mysqli->error;
}

$mysqli->close();
?>
