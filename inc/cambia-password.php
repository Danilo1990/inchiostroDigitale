<?php 
session_start();
include 'configura-db.php'; 
include 'functions.php'; 

// Recupera la vecchia password dell'utente dal database
$user_id = $_SESSION['user_id']; // Assumi che tu abbia l'ID dell'utente in sessione
$new_password = $_POST['new_password'];
$sql = "SELECT password FROM user WHERE id_utente = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();
$stmt->close();

// Verifica se la vecchia password fornita dall'utente corrisponde a quella memorizzata
if (password_verify($_POST['old_password'], $hashed_password)) {

    if (strlen($new_password) < 8 || !preg_match('/[A-Z]/', $new_password)) {
        echo 'passChart';
        return false;
    }
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql_update = "UPDATE user SET password = ? WHERE id_utente = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $hashed_new_password, $user_id);

    if ($stmt_update->execute()) {
        echo 'passOk';
    } else {
        echo "error";
    }
} else {
    echo "errataPass";
}
