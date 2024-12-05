<?php
$host = 'localhost'; // или '127.0.0.1'
$dbname = 'test'; 
$username = 'root'; // Ваше имя пользователя (по умолчанию для phpMyAdmin это 'root')
$password = ''; // Пароль (по умолчанию для phpMyAdmin пустой)

try {
    // Создание PDO соединения
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
    die();
}
?>
