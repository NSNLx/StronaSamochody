<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    die('Musisz być zalogowany, aby edytować ogłoszenie.');
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
    $stmt = $pdo->prepare('SELECT * FROM ogloszenia WHERE IdOgloszenia = ? AND IdKlienta = ?');
    $stmt->execute([$ogloszenieId, $_SESSION['user_id']]);
    $ogloszenie = $stmt->fetch();

    if (!$ogloszenie) {
        die('Nie znaleziono ogłoszenia lub brak uprawnień.');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $cena = $_POST['cena'];
    $przebieg = $_POST['przebieg'];
    $rok = $_POST['rok'];
    $opis = $_POST['opis'];

    $stmt = $pdo->prepare('UPDATE ogloszenia SET Cena = ?, Przebieg = ?, Rocznik = ?, Opis = ? WHERE IdOgloszenia = ? AND IdKlienta = ?');
    $stmt->execute([$cena, $przebieg, $rok, $opis, $ogloszenieId, $_SESSION['user_id']]);

    header('Location: mojeOgloszenia.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPortal - Edytuj Ogłoszenie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1 class="logo">
            <span class="logo-black">Auto</span><span class="logo-orange">Portal</span>
        </h1>
        <nav>
            <ul>
                <li><a href="index.php">Strona Główna</a></li>
                <li><a href="ogloszenia.php">Ogłoszenia</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="onas.php">O Nas</a></li>
                <li><a href="panelUzytkownika.php">Panel Użytkownika</a></li>
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </nav>
        <button id="toggle-theme">🌙 Tryb Ciemny</button>
    </header>

    <main>
        <h2>Edytuj Ogłoszenie</h2>
        <form class="dodaj-ogloszenie-form" action="" method="POST">
            <label for="zdjecia">Zdjęcia:</label>
            <input type="file" id="zdjecia" name="zdjecia[]" accept="image/*" multiple required>
            <div id="preview-container"></div>
        
            <label for="marka">Marka:</label>
            <input type="text" id="marka" name="marka" placeholder="Podaj markę" required>
        
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" placeholder="Podaj model" required>
        
            <label for="cena">Cena (PLN):</label>
            <input type="number" id="cena" name="cena" placeholder="Podaj cenę" required>
        
            <label for="przebieg">Przebieg (km):</label>
            <input type="number" id="przebieg" name="przebieg" placeholder="Podaj przebieg" required>
        
            <label for="rok">Rok:</label>
            <input type="number" id="rok" name="rok" placeholder="Podaj rok produkcji" required>
        
            <label for="opis">Opis:</label>
            <textarea id="opis" name="opis" placeholder="Podaj opis ogłoszenia" rows="5" required></textarea>
        
            <button type="submit">Edytuj Ogłoszenie</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>