<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "myform"; // Базаныздын аты кандай болсо, ошону жазыңыз

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("MySQL'ге туташуу мүмкүн эмес: " . $conn->connect_error);
}
?>