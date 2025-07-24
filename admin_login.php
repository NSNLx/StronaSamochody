<?php
session_start();

$admin_pin_hash = password_hash('1234', PASSWORD_DEFAULT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pin = $_POST['admin_pin'];

    if (password_verify($pin, $admin_pin_hash)) {
        $_SESSION['is_admin'] = true;
        header('Location: adminPanel.php');
        exit;
    } else {
        echo "Nieprawidłowy PIN!";
    }
}
?>