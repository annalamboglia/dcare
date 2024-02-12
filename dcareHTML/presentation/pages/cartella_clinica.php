<!DOCTYPE html>
<html lang="it">

<head>

  <?php
  require __DIR__ . "/../../business_logic/permissionManager.php";
  require_once __DIR__ . "/../header.html";
  require_once __DIR__ . "/../../data_access/dao/PazienteDAO.php";
  require_once __DIR__ . "/../../data_access/dao/SchedaOrtodonticaDAO.php";
  require_once __DIR__ . "/../../data_access/dao/SchedaOdontoiatricaDAO.php";


  if (!isset($_GET["id"])) {
    header("Location: /index.php");
  }

  # GET DATI PAZIENTE
  $p = $pazienteDAO->getInfoPaziente($_GET["id"]);

  # DATI SCHEDE ORTODONTICHE
  $schedeOrtodontiche = $schedaOrtodonticaDAO->getSchedeOrtodontiche($_GET["id"]);

  # DATI SCHEDE ODONTOIATRCHE
  $schedeOdontoiatriche = $schedaOdontoiatricaDAO->getSchedeOdontoiatriche($_GET["id"]);
  ?>

  <title>Dcare: Cartella Clinica</title>


  <!-- Allert simbol -->
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
  </svg>

</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Including Sidebar -->
    <?php require __DIR__ . "/../sidebar.html" ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Including Topbar -->
      <?php require __DIR__ . "/../topbar.php" ?>

      <!-- begin main page -->
      <div class="container-fluid m-2">

        <!-- Allert cestino -->
        <?php if ($p["cestino"] == 1) { ?>
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
              <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div class="ml-2">
              Attenzione: questo paziente si trova nel cestino.
            </div>
          </div>
        <?php } ?>

        <!-- Cartella Header -->
        <div class="row no-gutters">
          <div class="h5 p-2 bd-highlight text-gray-800"><?php echo ($p['nome'] . " " . $p['cognome']); ?></div>
          <div class="h5 p-2 ml-auto bd-highlight text-gray-800">ID paziente: <?php echo ($p['id']); ?></div>
        </div>


        <!-- Riga per la separazione delle due colonne -->
        <div class="row no-gutters pr-2">

          <!-- Blocco sinistro -->
          <div class="col-12 col-md-3 order-1 order-md-0">

            <!-- Carta schede Odontoiatriche -->
            <div class="col-auto mb-2" style="height: 50%">
              <div class="card h-100">
                <div class="card-header bg-success">
                  <h5 class="text-white text-center">Schede Odontoiatriche</h5>
                </div>
                <div class="card-body p-0">

                  <!-- Blocco schede aperte -->
                  <div class="col m-0 p-0 h-100" style="overflow: auto;">

  
                    <?php foreach ($schedeOdontoiatriche as $scheda) { ?>
                      <div class="container-fluid p-0 border-bottom">
                        <a href="./scheda_odontoiatrica.php?id=<?php echo ($scheda['id']); ?>&scheda" class="btn btn-block shadow-none row-hover border-0" style="border-radius: 0;"><?php echo ($scheda['tipoPrestazione']); ?></a>
                      </div>
                    <?php } ?>


                  </div>
                  <!-- End blocco schede aperte -->
                </div>

                <!-- Bottone + per aggiungere schede odontoiatriche solo se l'utente non è cestinato -->
                <?php if ($p["cestino"] == 0) { ?>
                  <a class="btn btn-block border-top row-hover" data-toggle="modal" data-target="#modalCreaSchedaOdontoiatrica"><img src="/img/plus.svg"></img></a>
                <?php } ?>
              </div>
            </div>
            <!-- END carta scheda Odontoiatriche -->

            <!-- Carta schede ortodontiche -->
            <div class="col-auto mb-5" style="height: 50%">
              <div class="card h-100">
                <div class="card-header bg-success">
                  <h5 class="text-white text-center">Schede Ortodontiche</h5>
                </div>

                <div class="card-body p-0">

                  <!-- Blocco schede aperte -->
                  <div class="col m-0 p-0 h-100" style="overflow: auto;">


                    <?php foreach ($schedeOrtodontiche as $scheda) { ?>
                      <div class="container-fluid p-0 border-bottom">
                        <a href="./scheda_ortodontica.php?id=<?php echo ($scheda['id']); ?>&scheda" class="btn btn-block row-hover shadow-none border-0" style="border-radius: 0;"><?php echo ($scheda['tipoPrestazione']); ?></a>
                      </div>
                    <?php } ?>


                  </div>
                  <!-- End blocco schede ortodontiche aperte -->

                </div>

                <!-- Bottone + per aggiungere schede ortodontiche solo se l'utente non è cestinato-->
                <?php if ($p["cestino"] == 0) { ?>
                  <a class="btn btn-block border-top row-hover" data-toggle="modal" data-target="#modalCreaSchedaOrtodontica"><img src="/img/plus.svg"></img></a>
                <?php } ?>
              </div>
            </div>
            <!-- END carta schede ortodontiche-->

          </div>
          <!-- END blocco sinistro -->



          <!-- Blocco destro -->
          <div class="col-12 col-md-9 order-0 order-md-1">

            <!-- Contenitore carte blocco destro -->
            <div class="pr-0 ml-2">

              <!-- Card Dati anagrafici -->
              <div class="card shadow mb-4">
                <div class="card-header bg-primary">
                  <h5 class="text-white my-1">Dati anagrafici</h5>
                </div>

                <!-- Card Body Dati anagrafici -->
                <div class="card-body">

                  <div class="row">

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Nome</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['nome']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Cognome</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['cognome']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Data di nascita</label>
                      <!-- Viene controllata se la data non è nulla. Se è nulla, stampa vuoto -->
                      <input class="text-capitalize form-control bg-white" value="<?php if ($p["dataNascita"] != null) {
                                                                                    echo (date("d/m/Y", strtotime($p["dataNascita"])));
                                                                                  } else {
                                                                                    echo ("");
                                                                                  } ?>" readonly></input>
                    </div>

                  </div>


                  <div class="row">

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Residente in</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['residenza']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Provincia</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo strtoupper($p['provincia']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">CAP</label>
                      <input class="text form-control bg-white" value="<?php echo ($p['cap']); ?>" readonly></input>
                    </div>

                  </div>


                  <div class="row">

                    <div class="col-12 col-md-3 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Telefono fisso</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['telefono']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-3 mb-3">
                      <label class="label text-gray-900 ml-1">Cellulare</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['cellulare']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Indirizzo Email</label>
                      <input class="form-control bg-white" value="<?php echo ($p['email']); ?>" readonly></input>
                    </div>

                  </div>




                </div>
                <!-- END card body dati anagrafici -->
              </div>
              <!-- END card dati anagrafica -->


              <!-- Card dati fiscali start -->
              <div class="card shadow mb-3">
                <div class="card-header bg-primary">
                  <h5 class="text-white my-1">Dati fiscali del paziente o di chi ne fa le veci</h5>
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Nome</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['pnome']); ?>" readonly></input>

                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Cognome</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['pcognome']); ?>" readonly></input>

                    </div>


                    <div class=" col-12 col-md-4 mb-3">

                      <label class="label text-gray-900 ml-1">Sesso</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['psesso']); ?>" readonly></input>

                    </div>
                    <!-- container M-F end -->

                  </div>

                  <div class="row">


                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Nato/a a</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['pcittaNascita']); ?>" readonly></input>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Data di nascita</label>
                      <!-- Viene controllata se la data non è nulla. Se è nulla, stampa vuoto -->
                      <input class="text form-control bg-white" value="<?php if ($p["pdataNascita"] != null) {
                                                                          echo (date("d/m/Y", strtotime($p["pdataNascita"])));
                                                                        } else {
                                                                          echo ("");
                                                                        } ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Provincia</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo strtoupper($p['pprovinciaNascita']); ?>" readonly></input>
                    </div>



                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Residente in</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo ($p['presidenza']); ?>" readonly></input>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">Provincia</label>
                      <input class="text-capitalize form-control bg-white" value="<?php echo strtoupper($p['pprovincia']); ?>" readonly></input>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1">CAP</label>
                      <input class="text form-control bg-white" value="<?php echo ($p['pcap']); ?>" readonly></input>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-12 col-md-8 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Prestazioni per</label>
                      <input class="text form-control bg-white" value="<?php echo ($p['pprestazioni']); ?>" readonly></input>
                    </div>

                    <div class="col-12 col-md-4 mb-3">
                      <label class="label text-gray-900 ml-1" style="white-space: nowrap;">Codice Fiscale</label>
                      <input class="text form-control bg-white" value="<?php echo ($p['pcf']); ?>" readonly></input>
                    </div>

                  </div>


                </div>
                <!-- body card dati fiscali end -->
              </div>
              <!-- card dati fiscali end -->
            </div>
            <!-- End contenitore carte blocco destro -->
          </div>
          <!-- Fine blocco destro -->
        </div>
        <!-- END Riga per la separazione delle due colonne-->

        <!-- Footer bottoni -->
        <div class="row justify-content-end mt-4 mt-md-0">

          <!-- Pulsanti paziente non cestinato-->
          <?php if ($p["cestino"] == 0) { ?>
            <a class="btn btn-primary mx-1" href="./dati_paziente.php?id=<?php echo ($_GET["id"]) ?>">Modifica</a>
            <button type="button" class="btn btn-danger mx-1" data-toggle="modal" data-target="#modalEliminaPaziente">Elimina Paziente</button>

            <!-- Pulsanti paziente cestinato -->
          <?php } else { ?>
            <a class="btn btn-success mx-1" href="/business_logic/managerPazienti.php?id=<?php echo ($p["id"]) ?>&action=ripristinaPaziente">Ripristina paziente</a>
          <?php } ?>

        </div>
        <!-- End footer bottoni -->

      </div>
      <!-- end main page -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrappe r -->



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Modal conferma eliminazione -->
  <div class="modal fade" id="modalEliminaPaziente" role="dialog" aria-labelledby="modalEliminaPaziente" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white">Elimina Paziente</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Sei sicuro di voler eliminare il paziente <b><?php echo ($p["nome"] . " " . $p["cognome"]); ?></b>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <a type="button" class="btn btn-danger" href="/business_logic/managerPazienti.php?id=<?php echo ($p["id"]) ?>&action=cestinaPaziente">Elimina</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal creazione scheda ortodontica -->
  <div class="modal fade" id="modalCreaSchedaOrtodontica" role="dialog" aria-labelledby="modalCreaSchedaOrtodontica" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Scheda ortodontica</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/business_logic/managerScheda.php?id=<?php echo ($p["id"]) ?>&action=createSchedaOrtodontica" method="POST">
          <div class="modal-body">
            <label class="form-label text-gray-900">Tipo prestazione</label>
            <input type="text" maxlength="50" class="form-control" name="tipoPrestazione" value="" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <button type="submit" class="btn btn-primary">Crea</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal creazione scheda odontoiatrica -->
  <div class="modal fade" id="modalCreaSchedaOdontoiatrica" role="dialog" aria-labelledby="modalCreaSchedaOdontoiatrica" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Scheda odontoiatrica</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/business_logic/managerScheda.php?id=<?php echo ($p["id"]) ?>&action=createSchedaOdontoiatrica" method="POST">
          <div class="modal-body">
            <label class="form-label text-gray-900">Tipo prestazione</label>
            <input type="text" maxlength="50" class="form-control" name="tipoPrestazione" value="" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <button type="submit" class="btn btn-primary">Crea</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Including LogoutModal -->
  <?php require __DIR__ . "/../modals/logoutModal.html" ?>
  <?php require __DIR__ . "/../footer.html" ?>


</body>

</html>