<?php
$servername = "localhost"; // Обычно localhost на OpenServer
$username = "root";        // Стандартный пользователь
$password = "";            // Обычно пароль пустой
$dbname = "participants_db"; // Название базы данных

// Подключение к серверу MySQL
$conn = new mysqli($servername, $username, $password);

// Проверка подключения
if ($conn->connect_error) {
    die("Кошулуу болбой калды: " . $conn->connect_error);
}

// Базаны түзүү (если нет)
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "База данных ийгиликтүү түзүлдү!";
} else {
    echo "Ката база түзүүдө: " . $conn->error;
}

// Базага кошулуу
$conn = new mysqli($servername, $username, $password, $dbname);

// Таблицаны түзүү
$tableSql = "CREATE TABLE IF NOT EXISTS participants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    about TEXT,
    whatsapp VARCHAR(20),
    photo VARCHAR(255)
)";

if ($conn->query($tableSql) === TRUE) {
    echo "Таблица ийгиликтүү түзүлдү!";
} else {
    echo "Таблица түзүүдө ката: " . $conn->error;
}

$conn->close();
?>
