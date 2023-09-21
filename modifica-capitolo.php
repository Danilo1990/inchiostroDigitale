<?php
// Script per la modifica del capitolo attraverso la stampa del capitolo da modificare nel form sottostante

session_start();
include 'inc/control-login.php';
include 'inc/functions.php';
include 'inc/configura-db.php';
head('Modifica il capitolo'); 



if (isset($_POST['update_cap'])) {
    
    $id = $_POST['update_cap'];
    $query = "SELECT titolo, contenuto, data_corrente FROM pagine WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$result) {
        die("Errore nella query: " . mysqli_error($conn));
    }

    $dataRegistrazione = date("d/m/Y", strtotime($row["data_corrente"]));
    $titolo = $row['titolo'];
    $contenuto = $row['contenuto'];  
?>

<div class="row pt-5 pb-5 mt-5 mb-5 justify-content-center align-items-center">
    <section id="update_capitolo" class="pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 align-items-center justify-content-center">
                    <div class="card shadow bg-light">
                        <div class="card-header bg-black"><h3 class="text-white m-0 p-0">Modifica capitolo</h3></div>
                        <div class="card-body">
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="text" name="titolo" value="<?= $titolo ?>" class="form-control" required><br>
                                <textarea name="contenuto" rows="15" cols="30" class="form-control" required><?= $contenuto ?></textarea><br>
                                <button id="aggiornaCap" type="button" class="btn btn-primary btn-lg d-block w-100" name="aggiornaCap">Aggiorna</button>
                            </form>
                            <div class="mt-2"><p class="text-end">Capitolo scritto il <?= $dataRegistrazione ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php };
 
footerCustom();