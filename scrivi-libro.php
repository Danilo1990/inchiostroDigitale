<?php
// Pagina per inserimento, modifica e cancellazione capitoli
session_start();
include 'inc/control-login.php';
include 'inc/functions.php';
include 'inc/configura-db.php';
head($titolo = 'Home'); 
?>
<main id="main" class="mt-2 mb-2">
    <section id="inserisci_capitolo" class="py-5">
        <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 align-items-center justify-content-center">
                <div class="card shadow bg-light">
                    <div class="card-header bg-info"><h3 class="text-white m-0 p-0">Inserisci nuovo capitolo</h3></div>
                    <div class="card-body">
                        <form method="post" id="capitolo-form">
                            <input type="text" name="titolo" placeholder="Titolo del capitolo" class="form-control form-control-lg" required><br>
                            <textarea name="contenuto" rows="20" cols="50" placeholder="Contenuto" class="form-control" required></textarea><br>
                            <button type="button" class="btn btn-primary btn-lg w-100 text-uppercase" id="aggiungi">Aggiungi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Elimina e modifica capitolo -->
    <section id="option_capitolo" class="pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 align-items-center justify-content-center">
                <div class="row">
                    <div class="alert alert-success alert-dismissible" style="display:none" role="alert" id="alertDelete">   
                        <div id="messaggioDelete"></div>   
                        <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="col-12 col-xl-6 col-md-6">
                        <div class="card shadow bg-light mb-3">
                            <div class="card-header bg-dark"><h3 class="text-white m-0 p-0">Modifica capitolo</h3></div>
                            <div class="card-body">
                                <form method="post" action="modifica-capitolo.php" id="formMod">
                                    <select name="update_cap" class="form-control form-select-lg">
                                        <?php selectCapitoli($conn) ?>
                                    </select>
                                    <button type="submit" class="mt-2 btn btn-primary btn-lg w-100 text-uppercase" value="Visualizza">Visualizza</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6 col-md-6">
                        <div class="card shadow bg-light mb-3">
                            <div class="card-header bg-danger"><h3 class="text-white m-0 p-0">Elimina capitolo</h3></div>
                            <div class="card-body">
                                <form id="deleteForm" method="POST" id="formDel"> 
                                    <div id="messaggioDelete" class="alert alert-success" style="display:none"></div>
                                    <select name="delete_cap" id="deleteCap" class="form-control form-select-lg">
                                        <?php selectCapitoli($conn) ?>
                                    </select>
                                    <button type="button" class="mt-2 btn btn-danger btn-lg w-100 text-uppercase" id="eliminaCapitolo">Elimina capitolo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?php footerCustom() ?>


