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
    $email = $_POST['email'];
    $password = $_POST['password'];


    $stmt = $pdo->prepare('SELECT * FROM klienci WHERE Email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Haslo'])) {
        session_start();
        $_SESSION['user_id'] = $user['IdKlienta'];
        $_SESSION['user_name'] = $user['Imie'];
        header('Location: zalogowany.php');
        exit;
    } else {
        echo '<script>alert("Nieprawidłowy email lub hasło!");</script>';
    }
}
?>