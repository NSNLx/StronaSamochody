<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    die('Musisz być zalogowany, aby usunąć ogłoszenie.');
}

$host = '127.0.0.1';
$db = 'bazasamochody';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

if (isset($_GET['id'])) {
    $ogloszenieId = $_GET['id'];
    $stmt = $pdo->prepare('DELETE FROM ogloszenia WHERE IdOgloszenia = ? AND IdKlienta = ?');
    $stmt->execute([$ogloszenieId, $_SESSION['user_id']]);

    header('Location: mojeOgloszenia.php');
    exit;
} else {
    die('Nieprawidłowe żądanie.');
}
?>