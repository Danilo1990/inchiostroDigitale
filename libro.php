<?php 
// Creazione del file pdf con i dati estratti da DB
session_start();
include 'inc/control-login.php';
include 'inc/configura-db.php';
require('fpdf186/fpdf.php');  

$pdf = new FPDF();
$pdf->AddPage();

$idUtente = $_SESSION["user_id"]; 
$sql = "SELECT titolo, contenuto, data_corrente FROM pagine WHERE id_utente = $idUtente";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $dataRegistrazione = date("d/m/Y", strtotime($row["data_corrente"]));
    $titolo = $row["titolo"];
    $titolo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $titolo);
    $contenuto = $row['contenuto']; 
    $contenuto = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $contenuto);

    // Creo PDF
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(0, 10, $titolo, 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 10, $contenuto);
}

$pdf->Output();
$conn->close();