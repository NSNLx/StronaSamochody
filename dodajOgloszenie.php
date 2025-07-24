<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPortal - Dodaj Ogłoszenie</title>
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
            </ul>
        </nav>
        <button id="toggle-theme">🌙 Tryb Ciemny</button>
    </header>

    <main>
        <h2>Dodaj Ogłoszenie</h2>
        <form class="dodaj-ogloszenie-form" action="dodajOgloszenie2.php" method="POST" enctype="multipart/form-data">
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
        
            <button type="submit">Dodaj Ogłoszenie</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>