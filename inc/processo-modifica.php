<?php 
// Script per la modifica del capitolo

session_start();
include 'configura-db.php';

$id = $_POST['id']; 
$nuovoTitolo = $_POST['titolo'];
$nuovoContenuto = $_POST['contenuto'];

$query = "UPDATE pagine SET titolo = '$nuovoTitolo', contenuto = '$nuovoContenuto' WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "success";
} else {
    echo "Errore nell'aggiornamento: " . mysqli_error($conn);
}

mysqli_close($conn);
