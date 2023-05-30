<?php
// Підключення до бази даних
$host = 'localhost';
$port = '3306';
$user = 'root';
$password = 'root';
$database = 'myreviewsdb';

$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    die("Помилка підключення до бази даних: " . mysqli_connect_error());
}

// Вибірка відгуків з бази даних
$query = "SELECT * FROM reviews";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="review">';
        echo '<h3>' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>';
        echo '<p>' . $row['reviews'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'Немає відгуків.';
}

// Закриття з'єднання з базою даних
mysqli_close($connection);
?>
