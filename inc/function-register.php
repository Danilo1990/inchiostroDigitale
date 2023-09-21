<?php 
session_start();
include 'functions.php';
include 'configura-db.php';

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)) {
    alertCustom($text = "<i class=\"bi bi-exclamation-triangle fw-lg\"></i> La password deve contenere almeno 8 caratteri e una lettera maiuscola.", $class = "small", $type = 'danger', $align = 'start');
    return false;
}

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    alertCustom('Questo username esiste già', 'danger');
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$hashedPassword', 'writer')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Errore durante la registrazione: " . $conn->error;
    }
}