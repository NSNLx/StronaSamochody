<?php
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        die('Hasła nie są zgodne!');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $pdo->prepare('SELECT COUNT(*) FROM klienci WHERE Email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        die('Użytkownik z podanym adresem email już istnieje!');
    }


    $stmt = $pdo->prepare('INSERT INTO klienci (Imie, Nazwisko, Email, Numer, Haslo) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$firstName, $lastName, $email, $phone, $hashedPassword]);

    echo 'Rejestracja zakończona sukcesem!';
    header('Location: panelUzytkownika.php');
    exit;
}
?>