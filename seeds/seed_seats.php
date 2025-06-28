<?php
require '../connection/db.php';

$result = $mysqli->query("SELECT id FROM showtimes");

while ($show = $result->fetch_assoc()) {
    $showtime_id = $show['id'];

    foreach (range('A', 'C') as $row)
        foreach (range(1, 6) as $num) {
            $stmt = $mysqli->prepare("INSERT INTO seats (showtime_id, seat_row, seat_number, is_booked) VALUES (?, ?, ?, 0)");
            $stmt->bind_param("isi", $showtime_id, $row, $num);
            $stmt->execute();
        }
}

echo "Seats seeded successfully!";
