<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: panelUzytkownika.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPortal - Panel Użytkownika</title>
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
    <h2>Panel Użytkownika</h2>
    <p>Witaj, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! Wybierz jedną z poniższych opcji:</p>
    <div class="panel-options">
        <a href="dodajOgloszenie.php" class="panel-button">Dodaj Ogłoszenie</a>
        <a href="mojeOgloszenia.php" class="panel-button">Moje Ogłoszenia</a>
    </div>
</main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>