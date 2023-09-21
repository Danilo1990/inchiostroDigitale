<?php
// Inietta la headv
function head($titolo) { 
    include 'template/header.php';
}
function cssHeader() {
    $css = '<link href="/css/style.css" rel="stylesheet">';
    $css .= '<link href="/css/admin.css" rel="stylesheet">';
    $css .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">';
    $css .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">';
    $css .= '<link rel="preconnect" href="https://fonts.googleapis.com">';
    $css .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    $css .= '<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">';
    echo $css;
}
// Inietta il footer
function footerCustom() { 
    include 'template/footer.php';
}
// Script JS nel footer
function footerScripts() {
    $script = '';
    $script .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>';
    $script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
    $script .= '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    $script .= '<script src="js/main.js"></script>';
    $script .= '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo $script;
}
// Menu
function navMenu($class) { 
    include 'template/nav.php';
}
// Topbar Admin
function topMenuAdmin() { 
    include 'template/nav-admin.php';
}
// Menù mobile
function menuMobile() { ?>
    <div class="offcanvas offcanvas-start w-75" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <nav id="navbar" class="">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link  dark" href="/" ><i class="bi bi-house"></i> Home</a></li>
                <?php if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) { ?>
                    <li><a class="nav-link" href="/scrivi-libro.php#inserisci_capitolo"><i class="bi bi-pen"></i> Scrivi capitolo</a></li>
                    <li><a class="nav-link" href="/scrivi-libro.php#option_capitolo"><i class="bi bi-pen"></i> Modifica o elimina</a></li>
                    <li class="nav-item"><a class="nav-link dark" href="/il-mio-libro.php" target="_blank"><i class="bi bi-book"></i> Il tuo libro</a></li>
                    <li class="nav-item"><a class="getstarted nav-link dark text-uppercase" href="/area-riservata.php"><i class="bi bi-person"></i>  <?= $_SESSION['username'] ?></a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link dark" href="/register.php"><i class="bi bi-pencil-square"></i>Registrati</a></li>
                    <li class="nav-item"><a class="nav-link getstarted dark" href="/login.php"><i class="bi bi-box-arrow-in-right"></i> Accedi</a></li>
                <?php } ?>
            </ul>
        </nav>
      </div>
    </div>
<?php }
// Select con i capitoli inseriti
function selectCapitoli($conn) {
    $idUtente = $_SESSION["user_id"]; // Recupera l'ID dell'utente connesso dalla sessione
    $sql = "SELECT id, titolo FROM pagine WHERE id_utente = $idUtente";
    $result = $conn->query($sql);
    echo   '<option disabled selected>Seleziona il capitolo</option>' ;  
    while ($row = $result->fetch_assoc()) {
        $idCapitolo = $row["id"];
        $titolo = $row["titolo"];
        echo '<option value="' . $idCapitolo . '">' . $titolo . '</option>';
    }
}

// Sezione amministratore //

// Script per la stampa degli utenti
function administratorUserList($conn) { 
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql); ?>
    <div class="card shadow bg-light">
        <div class="card-header bg-primary ">
            <h2 class="card-title text-white mb-1">Utenti</h2>
        </div>
        <div class="card-body">
            <ul class="list-group"> 
                <?php 
                while ($row = $result->fetch_assoc()) :
                    if($row["role"] != 'administrator') {
                        echo '<li class="list-group-item w-100 py-4">';
                            echo '<div class="row  align-items-center h-100">';
                                echo '<div class="col-xl-10">';
                                    echo '<h4>'.$row["username"].'</h4>';
                                    echo '<p class="mb-0"><b>Ruolo:</b> '.$row["role"].'</p>';
                                echo '</div>';
                                echo '<div class="col-xl-2 text-center">';
                                    echo '<button class=" btn btn-danger btn-sm deleteUser" data-id="'.$row["id_utente"].'"><i class="bi bi-x-octagon"></i> Elimina</button>';
                                echo '</div>';
                            echo '</div>';
                        echo '</li>';
                    }
                endwhile; 
                ?>
            </ul>
        </div>
    </div>
<?php }
// Script per la stampa del numero degli utenti
function administratorUser($conn) { 
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    $num_rows = mysqli_num_rows($result);
    ?>
    <div class="card shadow bg-light">
        <div class="card-header bg-primary ">
        <h5 class="card-title text-white mb-1">Utenti totali</h5>
        </div>
        <div class="card-body">
        <h1 class="display-4 font-weight-bold text-primary text-center"><?= $num_rows ?></h1>
        </div>
    </div>
<?php }
// Script per la stampa del numero di libri inseriti
function administratorLibri($conn) { 
    $sql = "SELECT COUNT(DISTINCT id_utente) as libri FROM pagine";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();?>
    <div class="card shadow bg-light">
        <div class="card-header bg-success ">
            <h5 class="card-title text-white mb-1">Libri pubblicati</h5>
        </div>
        <div class="card-body">
            <h1 class="display-4 font-weight-bold text-success text-center"><?= $row["libri"] ?></h1>
        </div>
    </div>
<?php }
// Script per la stampa del numero di capitoli inseriti
function administratorCapitoli($conn) { 
    $capitoli = "SELECT titolo FROM pagine";
    $resultCap = $conn->query($capitoli); ?>
    <div class="card shadow bg-light">
        <div class="card-header bg-danger ">
            <h5 class="card-title text-white mb-1">Capitoli scritti</h5>
        </div>
        <div class="card-body">
            <h1 class="display-4 font-weight-bold text-danger text-center"><?= mysqli_num_rows($resultCap) ?></h1>
        </div>
    </div>
<?php }
function adminTitlePages() {
    
    $directory = "./";
    $files = scandir($directory);
    $files = array_diff($files, array(".", ".."));
    echo '<div class="card shadow bg-light">';
        echo '<div class="card-header bg-primary ">';
            echo '<h2 class="card-title text-white mb-1">Pagine</h2>';
        echo '</div>';
        echo '<div class="card-body">';
            echo '<ul class="list-group">';
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $name = str_replace('.php', '', $file);
                    $namePage = str_replace("-", " ", $name);
                    $uniqueId = str_replace(" ", "_", $name); // Crea un ID univoco basato sul nome della pagina
                    echo '<li class="list-group-item w-100">';
                        echo '<span class="color-dark text-uppercase fw-bold">'.$namePage.'</span>';
                        echo '<button class="float-end btn btn-danger btn-sm deletePage rounded-pill" data-id="'.$file.'">Elimina</button>';
                        echo '<a href="/'.$file.'" class="float-end btn btn-success btn-sm mx-1 rounded-pill">Visualizza</a>';
                    echo '</li>';
                }
            }
            echo '</ul>';
        echo '</div>';
    echo '</div>';
}