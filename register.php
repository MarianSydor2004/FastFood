<?php
// Перевірка, чи була надіслана форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Перевірка, чи всі поля форми були заповнені
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
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
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        // Перевірка, чи існує користувач з таким email
        $checkQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "Користувач з таким email уже існує. Будь ласка, увійдіть або оберіть інший email.";
        } else {
            // Хешування паролю
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Вставка даних користувача до бази даних
            $insertQuery = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashedPassword')";
            $insertResult = mysqli_query($connection, $insertQuery);

            if ($insertResult) {
                echo "Реєстрація успішна.";
            } else {
                echo "Помилка реєстрації: " . mysqli_error($connection);
            }
        }

        // Закриття з'єднання з базою даних
        mysqli_close($connection);
    } else {
        echo "Будь ласка, заповніть усі поля форми.";
    }
}
?>
