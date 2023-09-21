<header id="header" class="-top bg-primary">
    <div class="container d-flex align-items-center">
        <a href="index.html" class="logo me-auto"><img src="/img/Logo.png" alt="" class="img-fluid"></a>
        <nav id="navbar" class="navbar">
            <ul class="nav <?= $class ?>">
                <li class="nav-item"><a class="nav-link  dark" href="/" ><i class="bi bi-house"></i> Home</a></li>
                <?php if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-pen"></i> Scrivi il libro</a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link dropdown-item" href="/scrivi-libro#inserisci_capitolo"> Inserisci capitolo</a></li>
                            <li><a class="dropdown-item" href="/scrivi-libro#option_capitolo">Modifica o elimina</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link dark" href="/il-mio-libro" target="_blank"><i class="bi bi-book"></i> Il tuo libro</a></li>
                    <li class="nav-item"><a class="getstarted nav-link dark text-uppercase" href="/area-riservata"><i class="bi bi-person"></i>  <?= $_SESSION['username'] ?></a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link dark" href="/register"><i class="bi bi-pencil-square"></i>Registrati</a></li>
                    <li class="nav-item"><a class="nav-link getstarted dark" href="/login"><i class="bi bi-box-arrow-in-right"></i> Accedi</a></li>
                <?php } ?>
            </ul>
            <button class="btn btn-primary d-xl-none d-sm-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="bi bi-list mobile-nav-toggle"></i>
            </button> 
        </nav>
    </div>
</header><!-- End Header -->