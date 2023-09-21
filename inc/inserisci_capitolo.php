<?php
// Processo di inserimento capitoli
session_start();
include "configura-db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $titolo = $_POST["titolo"];
    $contenuto = $_POST["contenuto"];
    $idUtente = $_SESSION["user_id"];
    $dataCorrente = date("Y-m-d");

    if($titolo == '' || $contenuto == '') {
        return false;
    }

    $sql = "INSERT INTO pagine (titolo, contenuto, data_corrente, id_utente) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo "Errore nella preparazione della dichiarazione: " . $conn->error;
    } else {
        // Esegui il binding dei parametri
        $stmt->bind_param("sssi", $titolo, $contenuto, $dataCorrente, $idUtente);
        
        // Esegui la query
        if ($stmt->execute()) {
            echo "successo"; // Restituisci "successo" se l'inserimento ha successo
        } else {
            echo "Errore nell'inserimento del nuovo capitolo: " . $stmt->error;
        }

        // Chiudi la dichiarazione e la connessione
        $stmt->close();
        $conn->close();
    }
} else {
    // Gestisci il caso in cui non sia stata inviata una richiesta POST
    echo "Nessuna richiesta POST inviata.";
}