<?php
session_start();
include 'inc/functions.php';
include 'inc/configura-db.php';
head($titolo = 'Home'); 
?>

<section id="" class="d-flex align-items-center vh-100">
  <div class="container">
    <div class="row pt-5 pb-5 mt-5 mb-5 justify-content-center align-items-center">
      <div class="col-lg-6 d-flex flex-column justify-content-center ">
        <h1>Benvenuto su Inchiostro Digitale</h1>
        <h3>La tua piattaforma per scrivere, modificare ed esportare il tuo libro</h3>
        <p class="py-3">Esplora un nuovo modo di scrivere e gestire i tuoi libri online con il Gestore di Libri Online. Crea capitoli, apporta modifiche al tuo racconto e ottieni il tuo libro in formato PDF con facilità. Un ambiente di scrittura intuitivo e una piattaforma potente ti consentono di concentrarti sulla tua creatività senza distrazioni.</p>
        <p class="text-success fw-semibold fs-6 text"> Inizia oggi stesso a trasformare le tue idee in storie straordinarie!</p>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img">
        <img src="/img/slide.png" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>
</section><!-- End Hero -->
<?php footerCustom();