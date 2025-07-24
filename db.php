<?php
// filepath: v:\xampp\htdocs\AutoPortal\db.php
$host = 'localhost';
$db   = 'bazasamochody'; // nazwa Twojej bazy danych
$user = 'root';       // użytkownik bazy (domyślnie root w XAMPP)
$pass = '';           // hasło (domyślnie puste w XAMPP)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO($dsn, $user, $pass, $options);
?>