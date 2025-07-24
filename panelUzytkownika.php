<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Użytkownika - AutoPortal</title>
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

    <main class="user-panel">
        <div class="form-container">
            <input type="radio" id="login-tab" name="tab" checked>
            <input type="radio" id="register-tab" name="tab">
            <input type="radio" id="admin-tab" name="tab">

            <div class="tab-buttons">
                <label for="login-tab">Logowanie</label>
                <label for="register-tab">Rejestracja</label>
                <label for="admin-tab">Administrator</label>
            </div>

            <form id="login-form" class="form" action="login.php" method="POST">
                <h2>Logowanie</h2>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Hasło" required>
                <button type="submit">Zaloguj się</button>
            </form>

            <form id="register-form" class="form" action="rejestracja.php" method="POST">
                <h2>Rejestracja</h2>
                <input type="text" name="first_name" placeholder="Imię" required>
                <input type="text" name="last_name" placeholder="Nazwisko" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="text" name="phone" placeholder="Numer" required>
                <input type="password" name="password" placeholder="Hasło" required>
                <input type="password" name="confirm_password" placeholder="Powtórz hasło" required>
                <button type="submit">Załóż konto</button>
            </form>

<form id="admin-form" class="form" action="admin_login.php" method="POST">
    <h2>Logowanie Administratora</h2>
    <input type="password" name="admin_pin" placeholder="PIN" required>
    <button type="submit">Zaloguj się</button>
</form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 AutoPortal</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>