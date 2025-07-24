<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die('Musisz być zalogowany, aby dodać ogłoszenie.');
}

$host = '127.0.0.1';
$db = 'bazasamochody';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//$row['kolumna']
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $przebieg = $_POST['przebieg'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO samochody (Marka, Model) VALUES (?, ?)');
    $stmt->execute([$marka, $model]);
    $samochodId = $pdo->lastInsertId();

    $stmt = $pdo->prepare('INSERT INTO ogloszenia (IdKlienta, IdSamochodu, Cena, Przebieg, Rocznik, Opis, dataDodania) VALUES (?, ?, ?, ?, ?, ?, NOW())');
    $stmt->execute([$userId, $samochodId, $cena, $przebieg, $rok, $opis]);
    $ogloszenieId = $pdo->lastInsertId();

    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    foreach ($_FILES['zdjecia']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['zdjecia']['name'][$key]);
        $filePath = $uploadDir . uniqid() . '_' . $fileName;

        if (move_uploaded_file($tmpName, $filePath)) {
            $stmt = $pdo->prepare('INSERT INTO zdjecia_ogloszen (IdOgloszenia, Sciezka) VALUES (?, ?)');
            $stmt->execute([$ogloszenieId, $filePath]);
        }
    }

    echo 'Ogłoszenie zostało dodane pomyślnie!';
    header('Location: mojeOgloszenia.php');
    exit;
}
?>