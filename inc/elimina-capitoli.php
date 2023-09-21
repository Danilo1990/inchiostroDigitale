<?php 
// Processo di eliminazione dei capitoli
session_start();

include 'control-login.php';
include 'functions.php';
include 'configura-db.php'; 


// Ricevi l'id_utente dalla richiesta POST
$delete_cap = $_POST['idsToDelete'];

// Esegui la query per eliminare le righe associate all'id_utente
$sql = "DELETE FROM pagine WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Errore nella preparazione della query: " . $conn->error;
} else {
    $stmt->bind_param("i", $delete_cap);
    
    if ($stmt->execute()) {
        $messaggio = "Capitolo eliminato con successo!";
    } else {
        echo "Errore nell'eliminazione delle pagine: " . $stmt->error;
    }

    $stmt->close();
}
