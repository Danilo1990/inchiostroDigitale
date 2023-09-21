<?php
session_start();
include 'inc/control-login.php';
include 'inc/functions.php';
include 'inc/configura-db.php';
head($titolo = 'Il mio libro'); 

$idUtente = $_SESSION["user_id"]; 
$sql = "SELECT titolo, contenuto, data_corrente FROM pagine WHERE id_utente = $idUtente";
$result = $conn->query($sql);

?>

<section id="" class="d-flex align-items-center">
  <div class="container ">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-12 d-flex flex-column justify-content-center">
        <!-- Card per file in PDF -->
        <div class="card text-white shadow p-2 w-75 m-auto bg-danger bg-gradient mb-4">
            <div class="row align-items-center px-4">
                <div class="col-lg-9 d-flex flex-column justify-content-center">
                    <div class="card-body">
                        <h4 class="card-title">Salva il tuo libro</h4>
                        <p class="card-text">Vuoi avere il tuo libro in PDF?</p>
                    </div>
                </div>
                <div class="col-lg-3 d-flex flex-column justify-content-center">
                    <a href="/libro.php" class="btn btn-light shadow"><i class="me-2 bi bi-filetype-pdf"></i>Vai al file</a>
                </div>
            </div>
        </div>
        <!-- Il libro -->
        <div class="shadow p-4 w-75 m-auto">
            <?php while ($row = $result->fetch_assoc()) : 
                $dataRegistrazione = date("d/m/Y", strtotime($row["data_corrente"]));
                $titolo = $row["titolo"];
                $contenuto = $row['contenuto'];
                echo '<div class="my-3">';
                    echo '<h3>'.$titolo,'</h3>';
                    echo '<p>'.$contenuto,'</p>';
                echo '</div>';
            endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero -->
<?php footerCustom();