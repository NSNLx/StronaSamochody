
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die('Musisz być zalogowany, aby przeglądać swoje ogłoszenia.');
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

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare('
    SELECT o.*, s.Marka, s.Model, GROUP_CONCAT(z.Sciezka SEPARATOR ",") AS Zdjecia
    FROM ogloszenia o
    JOIN samochody s ON o.IdSamochodu = s.IdSamochodu
    LEFT JOIN zdjecia_ogloszen z ON o.IdOgloszenia = z.IdOgloszenia
    WHERE o.IdKlienta = ?
    GROUP BY o.IdOgloszenia
');
$stmt->execute([$userId]);
$ogloszenia = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPortal - Moje Ogłoszenia</title>
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
        <h2>Moje Ogłoszenia</h2>
        <p>Przeglądaj, edytuj lub usuwaj swoje ogłoszenia.</p>
        <div class="ogloszenia-container">
    <?php if (count($ogloszenia) > 0): ?>
        <?php foreach ($ogloszenia as $ogloszenie): ?>
            <div class="ogloszenie">
                <div class="slider">
                    <?php 
                    $zdjecia = explode(',', $ogloszenie['Zdjecia']);
                    foreach ($zdjecia as $index => $zdjecie): 
                    ?>
                        <img src="<?php echo htmlspecialchars($zdjecie); ?>" alt="Zdjęcie samochodu" class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
                    <?php endforeach; ?>

                </div>
                <h3>Marka: <?php echo htmlspecialchars($ogloszenie['Marka']); ?></h3>
                <p>Model: <?php echo htmlspecialchars($ogloszenie['Model']); ?></p>
                <p>Cena: <?php echo htmlspecialchars($ogloszenie['Cena']); ?> PLN</p>
                <p>Przebieg: <?php echo htmlspecialchars($ogloszenie['Przebieg']); ?> km</p>
                <p>Rok: <?php echo htmlspecialchars($ogloszenie['Rocznik']); ?></p>
                <p>Opis: <?php echo htmlspecialchars($ogloszenie['Opis']); ?></p>
                <button class="edit-button"><a href="edytuj.php?id=<?php echo $ogloszenie['IdOgloszenia']; ?>">Edytuj</a></button>
                <button class="delete-button"><a href="usun.php?id=<?php echo $ogloszenie['IdOgloszenia']; ?>">Usuń</a></button>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nie masz jeszcze żadnych ogłoszeń.</p>
    <?php endif; ?>
</div>
    </main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>