  <?php
  $nomePagina = basename($_SERVER['PHP_SELF']);
  $nameclass = str_replace('.php', '', $nomePagina);
  if ($nomePagina != 'login.php' && $nomePagina != 'register.php' && $nomePagina != 'admin-dash.php') : ?>
    <footer id="" class="bg-dark py-3 text-white">
      <div class="container">
        <div>
          <div class="copyright float-start">
            &copy; Copyright <strong><span>Danilo Calabrese</span></strong>. All Rights Reserved
          </div>
          <div class="credits text-end">
            Designed by <a href="https://danilocalabrese.it" target="_blank">Danilo Calabrese</a>
          </div>
        </div>
        <div class="info d-block small mt-3 pb-2">
          <span>Questo è un sito web di prova creato per scopi di test e dimostrazione. Non contiene informazioni 
            reali o funzionalità operative. Si prega di tenere presente che tutto ciò che vedrete su questo sito 
            è simulato e non ha alcun valore effettivo. Siamo qui per mostrare le nostre capacità di sviluppo web e 
            per illustrare alcune delle nostre competenze. Grazie per la vostra visita e comprensione.</span>
        </div>
      </div>
    </footer>
  <?php endif; ?>

  <!-- Script -->
  <?php
  footerScripts();
  menuMobile();
  ?>
  </body>

  </html>