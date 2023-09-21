<?php
// Processo di cambio di password
// Form nella pagia area-riservata.php
session_start();
include 'inc/control-login.php';
include 'inc/functions.php';
include 'inc/configura-db.php';
head('Area riservata'); ?>

<main id="main" class="mt-2 mb-2">
    <section id="inserisci_capitolo" class="pt-2 pb-2">
        <div class="container">
            <div class="row pt-5 pb-5 mt-5 mb-5 justify-content-center align-items-center">
                <div class="col-lg-12 col-md-12 col-12 align-items-center justify-content-center">
                    <!-- Messaggio eliminazione pagina -->
                    <?php if (isset($_GET['delete'])) : ?>
                        <div class="alert alert-success alert-dismissible w-75" role="alert">   
                            <div><?= $_GET['delete'] ?></div>   
                            <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <!-- Card utente -->
                    <div class="mt-5 mb-5 p-5 bg-body-tertiary rounded-3 shadow">
                        <div class="container-fluid py-5">
                            <div class="text-end">
                                <button class="btn btn-warning text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-gear"></i></button>
                                <a href="/logout" class="btn btn-danger" type="button"><i class="bi bi-x-octagon"></i> Logout</a>
                            </div>
                            <h1 class="display-5 fw-bold">Benvenuto <?= $_SESSION["username"] ?></h1>
                            <?php if($_SESSION['role'] === 'administrator') { ?>
                                <a href="/admin-dash" class="btn btn-danger btn-lg" type="button"><i class="bi bi-person-fill-gear"></i> Pannello di controllo</a>
                            <?php } else { ?>
                                <p class="col-md-8 fs-4">Questa è la tua area riservata</p> 
                                <?php $idUtente = $_SESSION["user_id"];
                                $sql = "SELECT id, titolo FROM pagine WHERE id_utente = $idUtente";
                                $result = $conn->query($sql);
                                $num_rows = mysqli_num_rows($result);
                                if($num_rows > 0) { ?>
                                    <p class="col-md-8 fs-6 text-success fw-medium">Complimenti! Hai già scritto: <?= $num_rows ?> capitoli</p>
                                <?php } else { ?>
                                    <p class="col-md-8 fs-5 text-danger fw-medium">Non hai ancora scritto nulla! Inizia a scrivere il tuo libro</p>
                                <?php } ?>
                            <?php } ?>
                            <!-- Sezione Opzioni -->
                            <div class="collapse mt-3" id="collapseExample">
                                <div class="option-content"> 
                                    <!-- Bottoni -->
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link fw-bolder p-3 active" aria-current="page"  data-toggle="tab" id="menu1"> <i class="me-2 bi bi-pass"></i>Cambia password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bolder p-3" data-toggle="tab" id="menu2"><i class="me-2 bi bi-envelope-plus"></i> Cambia email</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fw-bolder p-3" data-toggle="tab" id="menu3"><i class="me-2 bi bi-calendar2-x"></i> Elimina</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border border-top-0 p-3">
                                        <!-- Cambio pass -->
                                        <div id="menu1-content" class="tab-pane active">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label for="old_password">Vecchia Password:</label>
                                                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password">Nuova Password:</label>
                                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Conferma Nuova Password:</label>
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                                </div>
                                                <button id="changePass" type="button" class="mt-2 btn btn-lg btn-primary d-blck w-100">Cambia Password</button>
                                            </form>
                                        </div>
                                        <!-- Cambio email -->
                                        <div id="menu2-content" class="tab-pane">
                                            <form method="post" class="row g-3">
                                                <div class="col-12 col-md-8 col-xl-8">
                                                    <input type="email" class="form-control form-control-lg" id="new_email" name="new_email" value="<?= $_SESSION["email"] ?>">
                                                </div>
                                                <div class="col-12 col-md-4 col-xl-4">
                                                    <button type="button" id="changeEmail" class="btn-lg btn btn-primary d-blck w-100">Cambia email</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Elimina -->
                                        <div id="menu3-content" class="tab-pane">
                                            <div class="d-md-block">
                                                <button class="btn btn-dark btn-lg deleteUser" type="button" name="deleteUser" data-id="<?php echo $idUtente; ?>">Elimina account</button>
                                            </div>  
                                        </div>
                                    </div>
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


