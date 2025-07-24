<?php
// Połączenie z bazą danych
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


$sql = '
    SELECT o.*, s.Marka, s.Model, k.Email, k.Numer AS Telefon, GROUP_CONCAT(z.Sciezka SEPARATOR ",") AS Zdjecia
    FROM ogloszenia o
    JOIN samochody s ON o.IdSamochodu = s.IdSamochodu
    JOIN klienci k ON o.IdKlienta = k.IdKlienta
    LEFT JOIN zdjecia_ogloszen z ON o.IdOgloszenia = z.IdOgloszenia
    WHERE 1=1
';


$params = [];

if (!empty($_POST['marka'])) {
    $sql .= ' AND s.Marka = ?';
    $params[] = $_POST['marka'];
}

if (!empty($_POST['model'])) {
    $sql .= ' AND s.Model = ?';
    $params[] = $_POST['model'];
}

if (!empty($_POST['rok_min'])) {
    $sql .= ' AND o.Rocznik >= ?';
    $params[] = $_POST['rok_min'];
}

if (!empty($_POST['rok_max'])) {
    $sql .= ' AND o.Rocznik <= ?';
    $params[] = $_POST['rok_max'];
}

$sql .= ' GROUP BY o.IdOgloszenia';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$ogloszenia = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPortal - Ogłoszenia</title>
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
        <h2>Ogłoszenia</h2>
    
    <!--    <div class="sortowanie">
            <label for="sort">Sortuj według:</label>
            <select id="sort">
                <option value="cena-rosnaco">Cena rosnąco</option>
                <option value="cena-malejaco">Cena malejąco</option>
                <option value="rocznik-malejaco">rocznik malejąco</option>
                <option value="rocznik-rosnaco">rocznik rosnąco</option>
                <option value="przebieg-malejaco">przebieg malejąco</option>
                <option value="przebieg-rosnaco">przebieg rosnąco</option>
            </select>
-->
            <form method="POST" action="ogloszenia.php">
    <label for="filter-marka">Wybierz markę:</label>
    <input type="text" id="filter-marka" name="marka" placeholder="Wpisz markę">

    <label for="filter-model">Wybierz model:</label>
<input type="text" id="filter-model" name="model" placeholder="Wpisz model">

    <label for="rok-min">Rok od:</label>
    <input type="number" id="rok-min" name="rok_min" min="1920" max="2025" value="1920">

    <label for="rok-max">Rok do:</label>
    <input type="number" id="rok-max" name="rok_max" min="1920" max="2025" value="2025">

    <button type="submit">Filtruj</button>
</form>
            </div>
        </div>
    
        <div class="ogloszenia-container">
    <?php if (count($ogloszenia) > 0): ?>
        <?php foreach ($ogloszenia as $ogloszenie): ?>
            <div class="ogloszenie">
                <img src="<?php echo explode(',', $ogloszenie['Zdjecia'])[0] ?? 'placeholder.jpg'; ?>" alt="Zdjęcie samochodu">
                <h3>Marka: <?php echo htmlspecialchars($ogloszenie['Marka']); ?></h3>
                <p>Model: <?php echo htmlspecialchars($ogloszenie['Model']); ?></p>
                <p>Cena: <?php echo htmlspecialchars($ogloszenie['Cena']); ?> PLN</p>
                <p>Przebieg: <?php echo htmlspecialchars($ogloszenie['Przebieg']); ?> km</p>
                <p>Rok: <?php echo htmlspecialchars($ogloszenie['Rocznik']); ?></p>
                <p>Email: <?php echo htmlspecialchars($ogloszenie['Email']); ?></p>
                <p>Telefon: <?php echo htmlspecialchars($ogloszenie['Telefon']); ?></p>
                <p>Opis: <?php echo htmlspecialchars($ogloszenie['Opis']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Brak ogłoszeń spełniających podane kryteria.</p>
    <?php endif; ?>
</div>
    </main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>