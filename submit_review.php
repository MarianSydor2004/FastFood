<?php
// Перевірка, чи була надіслана форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Перевірка, чи всі поля форми були заповнені
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['review'])) {
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

        // Екранування вхідних даних для запобігання SQL-ін'єкції
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $review = mysqli_real_escape_string($connection, $_POST['review']);

        // Вставка відгуку до бази даних
        $query = "INSERT INTO reviews (first_name, last_name, reviews) VALUES ('$first_name', '$last_name', '$review')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "Відгук успішно додано.";
        } else {
            echo "Помилка додавання відгука: " . mysqli_error($connection);
        }

        // Закриття з'єднання з базою даних
        mysqli_close($connection);
    } else {
        echo "Будь ласка, заповніть усі поля форми.";
    }
}
?>

