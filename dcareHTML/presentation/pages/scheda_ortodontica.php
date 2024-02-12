<!DOCTYPE html>
<html lang="it">

<head>

  <?php
  require __DIR__ . "/../../business_logic/permissionManager.php";
  require_once __DIR__ . "/../../util/definitions.php";
  require_once __DIR__ . "/..//header.html";
  require_once __DIR__ . "/../../data_access/dao/SchedaOrtodonticaDAO.php";
  require_once __DIR__ . "/../../data_access/dao/NotaOrtodonticaDAO.php";

  $s = $schedaOrtodonticaDAO->getInfoSchedaOrtodontica($_GET["id"]);
  $id_paziente = $s["id_paziente"];

  // VARIABILE PER LA SEZIONE CONTABILITA
  $tipo_scheda = SCHEDA_ORTODONTICA;

  // SALVATAGGIO NUOVO ACCESSO
  $schedaOrtodonticaDAO->saveAccess($_GET["id"], date("Y-m-d"));

  // OTTENIMENTO DIARIO
  $diarioOrtodontico = $notaOrtodonticaDAO->getDiario($_GET["id"]);

  // Get role
  $is_cestinato = $s["cestino"];
  $is_dentista = checkPermission($_SESSION["role"]) && !$s["cestino"];

  ?>


  <title>Dcare: Scheda Ortodontica</title>


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
      <div class="container-fluid mx-3">

        <!-- Barra navigazione elementi scheda -->
        <?php require_once __DIR__ . "/../barra_navigazione_scheda.php" ?>

        <!-- End barra navigazione elementi scheda -->

        <!-- Schede di pills -->
        <div class="tab-content" id="pills-tabContent">

          <!-- Scheda page -->
          <div class="tab-pane fade  <?php if (isset($_GET["scheda"])) echo ("show active") ?>" id="pills-scheda">

            <!-- Main card -->
            <div class="card shadow mb-3">

              <div class="card-header d-flex justify-content-between bg-primary text-white">
                <?php include_once __DIR__ . "/../scheda_header.php"; ?>
              </div>

              <!-- Main card body -->
              <div class="card-body">

                <!-- Row diario e destra -->
                <div class="row no-gutters">

                  <!-- Tabella Diario card-->
                  <div class="col-12 col-md-7 px-0 card order-1 order-md-0">

                    <div class="card-header">
                      <h5>Diario</h5>
                    </div>

                    <div class="card-body p-0" style="height: 40vh; overflow: auto;">

                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Data</th>
                            <th scope="col" width="80%">Note</th>
                          </tr>
                        </thead>

                        <tbody>
                          <!-- Stampa diario ortodontico -->
                          <?php foreach ($diarioOrtodontico as $d) { ?>

                            <?php if($is_dentista && !$is_cestinato) : ?>
                            <tr id="<?php echo $d["id"]; ?>" onclick="setModalModificaDiario(this, this.id)" class="row-hover" data-toggle="modal" data-target="#modalModificaDiario">
                            <?php else : ?>
                            <tr id="<?php echo $d["id"]; ?>">
                            <?php endif ?>
                              <td><?php echo date("d-m-Y", strtotime($d["data"])) ?></td>
                              <td><?php echo ($d["testo"]) ?></td>
                            </tr>

                          <?php } ?>
                          <!-- End stampa diario ortodontico -->

                        </tbody>
                      </table>

                    </div>
                    <!-- End tabella diario card body -->
                  </div>
                  <!-- End tabella diario card-->

                  <!-- Section destra tabella -->
                  <div class="col-12 col-md-5 mr-0 mb-3 mb-md-0 pl-0 pl-md-2 pr-0 order-0 order-md-1">

                    <div class="d-flex flex-column">

                      <!-- Tipo prestazione -->
                      <div class="card mt-0 mb-3">
                        <div class="card-header bg-info">
                          <span class="text-white">Tipo prestazione</span>
                        </div>
                        <?php if($is_dentista && !$is_cestinato) : ?>
                        <div class="card-body row no-gutters row-hover" data-toggle="modal" data-target="#modalModificaTipoPrestazione">
                        <?php else : ?>
                        <div class="card-body row no-gutters">
                        <?php endif ?>
                          <span class="ml-2"><?php echo ($s["tipoPrestazione"]); ?></span>
                        </div>
                      </div>
                      <!-- End tipo prestazione -->

                      <!-- Prestazione in programma -->
                      <div class="card mb-3">
                        <div class="card-header bg-info">
                          <span class="text-white">Prestazione in programma <?php if ($s['dataProssimoAppuntamento'] != "") echo (date("d-m-Y", strtotime($s['dataProssimoAppuntamento']))); ?></span>
                        </div>
                        <div class="card-body">
                          <span><?php echo ($s["notaProssimoAppuntamento"]); ?></span>
                        </div>
                      </div>
                      <!-- End prestazione in programma -->

                      <!-- Form per la prestazaione odierna -->
                      <form action="/business_logic/managerScheda.php?id_scheda=<?php echo ($_GET['id']); ?>" method="POST">

                        <!-- Prestazione odierna -->
                        <div class="card">
                          <div class="card-header bg-info">
                            <span class="text-white">Prestazione odierna</span>
                          </div>
                          <div class="card-body px-0 pb-0 py-2">
                            <textarea class="form-control border-0 shadow-none bg-white" name="inputPrestazioneOdierna" rows="6" maxlength="255" required <?php if(!$is_dentista && !$is_cestinato) echo "disabled"; ?>></textarea>
                          </div>
                        </div>
                        <!-- End prestazione odierna -->

                        <?php if($is_dentista && !$is_cestinato) : ?>
                          <div class="d-flex flex-row-reverse mt-2">
                            <button type="submit" class="btn btn-primary" name="aggiungiNotaOrtodontica">Registra prestazione</button>
                          </div>
                        <?php endif ?>

                      </form>
                      <!-- End form per la prestazione ordierna -->

                    </div>

                  </div>
                  <!-- End section destra tabella -->

                </div>
                <!-- End row diario e destra -->

                <?php if($is_dentista && !$is_cestinato) : ?>
                <!-- Card campi per la prestazione -->
                <div class="card mt-5 p-2">

                  <!-- Card body prestazione -->
                  <div class="card-body">

                    <!-- FORM per la prestazione odierna e futura -->
                    <form action="/business_logic/managerScheda.php?id_scheda=<?php echo ($_GET['id']); ?>" method="POST">


                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">Al prossimo appuntamento: </span>
                        </div>
                        <input class="form-control" name="notaProssimoAppuntamento" maxlength="50">
                      </div>

                      <div class="input-group mt-4">

                        <div class="input-group-prepend">
                          <span class="input-group-text bg-primary text-white">Da rivedere tra: </span>
                        </div>

                        <div class="col-12 col-md-2 px-0">
                          <input type="number" min="0" class="form-control" name="daRivedereTra">
                        </div>

                        <div class="col-2 pl-0">
                          <select id="inputTipo" class="form-control" name="unitaTempo" required>
                            <option selected>Giorni</option>
                            <option>Mesi</option>
                          </select>
                        </div>

                        <button type="submit" class="btn btn-primary ml-auto" name="aggiungiProssimoAppuntamento">Registra</button>

                      </div>

                    </form>
                    <!-- End form per la prestazione odierna e futura -->

                  </div>
                  <!-- End card body prestazione -->

                </div>
                <!-- End card campi per la prestazione -->
                <?php endif ?>

                <!-- Footer buttons -->
                <?php if(!$is_cestinato): ?>
                <div class="row">

                  <div class="col-auto ml-auto">
                    <a class="btn btn-danger mx-1 mt-3" data-toggle="modal" data-target="#modalEliminaScheda">Elimina scheda</a>
                  </div>

                </div>
                <?php endif ?>
                <!-- End footer eliminazione -->

              </div>
              <!-- End main card body -->

            </div>
            <!-- End Main card -->


          </div>
          <!-- End Scheda page -->

          <!-- Contabilità page -->
          <div class="tab-pane fade <?php if (isset($_GET["contabilita"])) echo ("show active") ?>" id="pills-contabilita">
            <?php include_once __DIR__ . "/scheda_contabilita.php"; ?>
          </div>
          <!-- End contabilità page -->

          <!-- Scheda immagini -->
          <div class="tab-pane fade <?php if (isset($_GET["immagini"])) echo ("show active") ?>" id="pills-immagini">
            <?php include_once __DIR__ . "/scheda_immagini.php"; ?>
          </div>
          <!-- End scheda imamagini -->

        </div>
        <!-- End schede di pills -->
      </div>
      <!-- end main page -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->



  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal conferma eliminazione scheda -->
  <?php include_once __DIR__ . "/../modals/modal_elimina_scheda.php"; ?>

  <!-- Modal modifica diario -->
  <div class="modal fade" id="modalModificaDiario" role="dialog" aria-labelledby="modalModificaDiario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Modifica nota diario</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="modalModificaDiarioForm" action="" method="POST">
          <div class="modal-body">

            <label class="form-label text-gray-900">Data</label>
            <input id="modalModificaDiarioData" type="date" class="form-control" placeholder="gg/mm/aaaa" name="data" value="">
            <br>
            <label class="form-label text-gray-900">Nota</label>
            <input id="modalModificaDiarioNota" type="text" class="form-control" maxlength="255" placeholder="Nota" name="nota" value="">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger mr-auto" data-toggle="modal" data-target="#modalEliminaDiario" data-dismiss="modal" onclick="removeFadeModalModificaDiario()">Elimina</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <button class="btn btn-primary" name="modificaNotaOrtodontica">Modifica</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal elimina diario -->
  <div class="modal" id="modalEliminaDiario" role="dialog" aria-labelledby="modalEliminaDiario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white">Elimina nota diario</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalEliminaDiarioText" class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <a id="modalEliminaDiarioButton" type="button" class="btn btn-danger" href="">Elimina</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal modifica tipo prestaizone -->
  <?php include_once __DIR__ . "/../modals/modal_modifica_tipo_prestazione.php"; ?>

  <?php include_once __DIR__ . "/../modals/modal_open_scheda.php" ?>


  <script>
    /* Script per la modifica del modal Modifica Diario */
    function setModalModificaDiario(tr_tag, id_nota) {

      /* Aggiunta fade */
      modalModifica = document.getElementById("modalModificaDiario");
      modalModifica.classList.add("fade");

      /* Figli del tr: data e nota */
      tds = tr_tag.getElementsByTagName("td");

      let id_scheda = <?php echo ($_GET["id"]); ?>;

      /* Campi del modal modifica */
      let form = document.getElementById("modalModificaDiarioForm");
      let inputNota = document.getElementById("modalModificaDiarioNota");
      let inputData = document.getElementById("modalModificaDiarioData");


      let action = "/business_logic/managerScheda.php?id_nota=:id_nota&id_scheda=:id_scheda";
      let new_action = action.replace(":id_nota", id_nota);
      new_action = new_action.replace(":id_scheda", id_scheda);
      form.setAttribute("action", new_action);

      inputData.value = tds[0].innerHTML;
      inputNota.value = tds[1].innerHTML;

      setModalEliminaDiario(tr_tag, id_nota)
    }

    /* Script per la modifica del modal Elimina Diario */
    function setModalEliminaDiario(tr_tag, id_nota) {

      tds = tr_tag.getElementsByTagName("td");

      let modalEliminaDiarioText = document.getElementById("modalEliminaDiarioText");
      let text = "Sei sicuro di voler eliminare la nota del <b>:data</b> dal diario?<br>Una volta eliminata non sarà più possibile recuperarla.";
      let data = tds[0].innerHTML;
      text = text.replace(":data", data);
      modalEliminaDiarioText.innerHTML = text;

      let button = document.getElementById("modalEliminaDiarioButton");
      let href = "/business_logic/managerScheda.php?id_nota=:id_nota&id_scheda=<?php echo ($_GET["id"]); ?>&action=deleteNotaOrtodontica";
      href = href.replace(":id_nota", id_nota)
      button.setAttribute("href", href);
    }

    /* Rimozione fade out del modal modificaDiario premendo Elimina */
    function removeFadeModalModificaDiario() {
      modalModifica = document.getElementById("modalModificaDiario");
      modalModifica.classList.remove("fade");

    }
  </script>

  <!-- Script per visualizzare il nome dell'immagine caricata  -->
  <script type="text/javascript" src="../dynamic_interactions_ui/uploadImage.js"></script>


  <!-- Functions generali scheda -->
  <script type="text/javascript" src="../dynamic_interactions_ui/functions_scheda.js"></script>

  <!-- Including LogoutModal -->
  <?php require __DIR__ . "/../modals/logoutModal.html" ?>

  <?php require __DIR__ . "/../footer.html" ?>

</body>

</html>