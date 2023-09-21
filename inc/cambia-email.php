<?php 
// Processo di cambio email
// Form nella pagia area-riservata.php
session_start();
include 'configura-db.php'; 

$email_nuova = $_POST["new_email"];
$id_utente = $_SESSION['user_id'];

$sql = "SELECT * FROM user WHERE email = '$email_nuova'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo 'emailInUso';
} else {
    $sql_aggiorna_email = "UPDATE user SET email = ? WHERE id_utente = ?";
    $stmt_aggiorna_email = $conn->prepare($sql_aggiorna_email);

    if (!$stmt_aggiorna_email) {
        echo "error";
        exit();
    }

    $stmt_aggiorna_email->bind_param("si", $email_nuova, $id_utente);

    if ($stmt_aggiorna_email->execute()) {
        echo 'emailOk';
        $_SESSION["email"] = $email_nuova;
    } else {
        echo "error";
    }
    // Chiudi la dichiarazione
    $stmt_aggiorna_email->close();
}






