<?php
// Перевірка, чи була надіслана форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Перевірка, чи всі поля форми були заповнені
    if (isset($_POST['email_login']) && isset($_POST['password_login'])) {
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
        $email = mysqli_real_escape_string($connection, $_POST['email_login']);
        $password = mysqli_real_escape_string($connection, $_POST['password_login']);

        // Перевірка, чи існує користувач з таким email
        $checkQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $user = mysqli_fetch_assoc($checkResult);

            // Перевірка пароля
            if (password_verify($password, $user['password'])) {
                // Валідація пройшла успішно
                session_start();
                $_SESSION['user'] = $user;
                header('Location: index.php');
            } else {
                echo "Неправильний пароль.";
            }
        } else {
            echo "Користувача з таким email не знайдено.";
        }

        // Закриття з'єднання з базою даних
        mysqli_close($connection);
    } else {
        echo "Будь ласка, заповніть усі поля форми.";
    }
}
?>
