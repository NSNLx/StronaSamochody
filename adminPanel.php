<?php
session_start();
if (empty($_SESSION['is_admin'])) {
    header('Location: panelUzytkownika.php');
    exit;
}
require 'db.php';

if (isset($_POST['delete_ogloszenie'])) {
    $id = (int)$_POST['delete_ogloszenie'];
    $stmt = $pdo->prepare("DELETE FROM ogloszenia WHERE IdOgloszenia = ?");
    $stmt->execute([$id]);
}

if (isset($_POST['delete_klient'])) {
    $id = (int)$_POST['delete_klient'];
    $stmt = $pdo->prepare("DELETE FROM klienci WHERE IdKlienta = ?");
    $stmt->execute([$id]);
}

$ogloszenia = $pdo->query("
    SELECT o.*, k.Imie, k.Nazwisko, s.Marka, s.Model
    FROM ogloszenia o
    LEFT JOIN klienci k ON o.IdKlienta = k.IdKlienta
    LEFT JOIN samochody s ON o.IdSamochodu = s.IdSamochodu
    ORDER BY o.IdOgloszenia DESC")->fetchAll();

$klienci = $pdo->query("SELECT * FROM klienci")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPortal - Panel Administratora</title>
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
                <li><a href="wyloguj.php">Wyloguj</a></li>
            </ul>
        </nav>
        <button id="toggle-theme">🌙 Tryb Ciemny</button>
    </header>

    <main>
        <h2>Panel Administratora</h2>
        <p>Zarządzaj ogłoszeniami i klientami.</p>

        <div class="admin-panel-container">
            <section class="admin-section">
                <h3>Zarządzanie Ogłoszeniami</h3>
                <div class="ogloszenia-container">
                    <?php foreach ($ogloszenia as $ogloszenie): ?>
                    <div class="ogloszenie">
                        <p><strong>ID ogłoszenia:</strong> <?= htmlspecialchars($ogloszenie['IdOgloszenia']) ?></p>
                        <p><strong>Samochód:</strong> <?= htmlspecialchars($ogloszenie['Marka'] . ' ' . $ogloszenie['Model']) ?></p>
                        <p><strong>Klient:</strong> <?= htmlspecialchars($ogloszenie['Imie'] . ' ' . $ogloszenie['Nazwisko']) ?></p>
                        <p><strong>Cena:</strong> <?= htmlspecialchars($ogloszenie['Cena']) ?> zł</p>
                        <p><strong>Przebieg:</strong> <?= htmlspecialchars($ogloszenie['Przebieg']) ?> km</p>
                        <p><strong>Rocznik:</strong> <?= htmlspecialchars($ogloszenie['Rocznik']) ?></p>
                        <p><strong>Opis:</strong> <?= htmlspecialchars($ogloszenie['Opis']) ?></p>
                        <p><strong>Data dodania:</strong> <?= htmlspecialchars($ogloszenie['dataDodania']) ?></p>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_ogloszenie" value="<?= $ogloszenie['IdOgloszenia'] ?>">
                            <button type="submit" class="delete-button" onclick="return confirm('Na pewno usunąć ogłoszenie?')">Usuń ogłoszenie</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="admin-section">
                <h3>Zarządzanie Klientami</h3>
                <div class="klienci-container">
                    <?php foreach ($klienci as $klient): ?>
                    <div class="klient">
                        <p><strong>ID:</strong> <?= htmlspecialchars($klient['IdKlienta']) ?></p>
                        <p><strong>Imię:</strong> <?= htmlspecialchars($klient['Imie']) ?></p>
                        <p><strong>Nazwisko:</strong> <?= htmlspecialchars($klient['Nazwisko']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($klient['Email']) ?></p>
                        <p><strong>Numer:</strong> <?= htmlspecialchars($klient['Numer']) ?></p>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_klient" value="<?= $klient['IdKlienta'] ?>">
                            <button type="submit" class="delete-button" onclick="return confirm('Na pewno usunąć klienta?')">Usuń klienta</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>