<?php
// Включение отображения ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Настройки подключения к базе данных
$host = 'localhost'; // или ваш хост
$db = 'reviews_db';
$user = 'root'; // замените на ваше имя пользователя
$pass = ''; // замените на ваш пароль

// Подключение к базе данных
$conn = new mysqli($host, $user, $pass, $db);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверка метода запроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Вывод данных для проверки
    echo "Rating: " . $rating . "<br>";
    echo "Comment: " . $comment . "<br>";

    // Подготовка и выполнение SQL-запроса
    $stmt = $conn->prepare("INSERT INTO reviews (rating, comment) VALUES (?, ?)");
    $stmt->bind_param("is", $rating, $comment);

    if ($stmt->execute()) {
        echo "Отзыв успешно сохранен!";
    } else {
        echo "Ошибка: " . $stmt->error; // Вывод ошибки
    }

    // Закрытие соединения
    $stmt->close();
}

$conn->close();
?>