<!DOCTYPE html>
<html lang="it">

<head>

  <?php
  require __DIR__ . "/../../business_logic/permissionManager.php";
  require_once __DIR__ . "/../../util/definitions.php";
  require_once __DIR__ . "/..//header.html";
  require_once __DIR__ . "/../../data_access/dao/SchedaOdontoiatricaDAO.php";
  require_once __DIR__ . "/../../data_access/dao/NotaOdontoiatricaDAO.php";
  require_once __DIR__ . "/../../data_access/dao/PrestazioneDAO.php";

  // Scheda odontoiatrica
  $tipo_scheda = SCHEDA_ODONTOIATRICA;

  // Recupero informazioni scheda
  $s = $schedaOdontoiatricaDAO->getInfoSchedaOdontoiatrica($_GET["id"]);
  $id_paziente = $s['id_paziente'];

  // Salvataggio ultimo accesso
  $schedaOdontoiatricaDAO->saveAccess($_GET["id"], date("Y-m-d"));

  // Recupero informazioni sul diario
  $trattamenti = $notaOdontoiatricaDAO->getDiario($_GET["id"]);

  // Recupero prestazioni
  $prestazioni = $prestazioneDAO->getPrestazioni();

  // Get ruolo
  $is_cestinato = $s["cestino"];
  $is_dentista = checkPermission($_SESSION["role"]); 

  ?>




  <title>Dcare: Scheda Odontoiatrica</title>


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Including Sidebar -->
    <?php require __DIR__ . "/../sidebar.html"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Including Topbar -->
      <?php require __DIR__ . "/../topbar.php"; ?>

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

                <div class="row">

                  <!-- Bocca -->
                  <div class="col">

                    <!-- Card bocca -->
                    <div class="card">

                      <div class="card-header">
                        <h5>Arcate</h5>
                      </div>

                      <!-- Card bocca body -->
                      <div class="card-body py-4">

                        <div class="row justify-content-center">

                          <!-- Colonna label sinistra -->
                          <div class="col-12 col-lg p-lg-0 order-1 order-lg-0">

                            <!-- Colonna superiore -->
                            <div class="d-flex flex-column" style="height: 50%; justify-content: space-between;">

                              <?php for ($i = 11; $i <= 18; $i++) : ?>

                                <div class="d-flex flex-row" <?php echo ("id=label_dent$i"); ?>>
                                  <div class="mx-0 pl-0 pl-lg-3 pr-3 order-lg-1" style="white-space: nowrap;"><?php echo ($i); ?></div>
                                  <div class="flex-grow-1">
                                    <input id="<?php echo ($i); ?>" class="form-control shadow-none bg-white" readonly></input>
                                  </div>
                                </div>

                              <?php endfor ?>

                            </div>
                            <!-- Colonna superiore -->

                            <!-- Colonna inferiore -->
                            <div class="d-flex flex-column mt-2" style="height: 50%; justify-content: space-between;">

                              <?php for ($i = 48; $i >= 41; $i--) : ?>

                                <div class="d-flex flex-row" <?php echo ("id=label_dent$i"); ?>>
                                  <div class="mx-0 pl-0 pl-lg-3 pr-3 order-lg-1" style="white-space: nowrap;"><?php echo ($i); ?></div>
                                  <div class="flex-grow-1">
                                    <input id="<?php echo ($i); ?>" class="form-control shadow-none bg-white" readonly></input>
                                  </div>
                                </div>

                              <?php endfor ?>

                            </div>
                            <!-- Colonna inferiore -->

                          </div>
                          <!-- End colonna label sinistra -->

                          <div class="d-flex order-0 order-lg-1">
                            <?php include_once __DIR__ . "/../bocca.html"; ?>
                          </div>

                          <!-- Colonna label destra -->
                          <div class="col-12 col-lg p-lg-0 mt-3 mt-lg-0 order-2">

                            <!-- Colonna superiore -->
                            <div class="d-flex flex-column" style="height: 50%; justify-content: space-between;">

                              <?php for ($i = 21; $i <= 28; $i++) : ?>

                                <div class="d-flex flex-row" <?php echo ("id=label_dent$i"); ?>>
                                  <div class="mx-0 pl-0 pl-lg-3 pr-3" style="white-space: nowrap;"><?php echo ($i); ?></div>
                                  <div class="flex-grow-1">
                                    <input id="<?php echo ($i); ?>" class="form-control shadow-none bg-white" readonly></input>
                                  </div>
                                </div>

                              <?php endfor ?>

                            </div>
                            <!-- End colonna superiore -->

                            <!-- Colonna inferiore -->
                            <div class="d-flex flex-column mt-2" style="height: 50%; justify-content: space-between;">

                              <?php for ($i = 38; $i >= 31; $i--) : ?>

                                <div class="d-flex flex-row" <?php echo ("id=label_dent$i"); ?>>
                                  <div class="mx-0 pl-0 pl-lg-3 pr-3" style="white-space: nowrap;"><?php echo ($i); ?></div>
                                  <div class="flex-grow-1">
                                    <input id="<?php echo ($i); ?>" class="form-control shadow-none bg-white" readonly></input>
                                  </div>
                                </div>

                              <?php endfor ?>

                            </div>
                            <!-- End colonna inferiore -->

                          </div>
                          <!-- End colonna lebel destra -->

                        </div>

                      </div>
                      <!-- End card bocca body -->
                    </div>
                    <!-- End card bocca -->
                  </div>
                  <!-- End Bocca -->


                  <!-- Colonna destra (quadranti, arcate, bocca) -->
                  <div class="col-12 col-md-3 mr-0 mb-3 mb-md-0 pl-0 pl-md-2 pr-0 order-0 order-md-1">

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
                          <span><?php echo ($s["tipoPrestazione"]); ?></span>
                        </div>
                      </div>
                      <!-- End tipo prestazione -->


                      <!-- Quadranti -->
                      <div class="card mt-0 mb-3">

                        <div class="card-header bg-info">
                          <span class="text-white">Quadrante</span>
                        </div>

                        <div class="card-body">

                          <div class="mb-3 row">
                            <label class="col-auto col-form-label">Q1</label>
                            <div class="col">
                              <input id="q1" class="form-control shadow-none bg-white" readonly></input>
                            </div>
                          </div>

                          <div class="mb-3 row">
                            <label class="col-auto col-form-label">Q2</label>
                            <div class="col">
                              <input id="q2" class="form-control shadow-none bg-white" readonly></input>
                            </div>
                          </div>

                          <div class="mb-3 row">
                            <label class="col-auto col-form-label">Q3</label>
                            <div class="col">
                              <input id="q3" class="form-control shadow-none bg-white" readonly></input>
                            </div>
                          </div>

                          <div class="row">
                            <label class="col-auto col-form-label">Q4</label>
                            <div class="col">
                              <input id="q4" class="form-control shadow-none bg-white" readonly></input>
                            </div>
                          </div>

                        </div>

                      </div>
                      <!-- End Quadranti -->

                      <!-- Arcate -->
                      <div class="card mb-3">

                        <div class="card-header bg-info">
                          <span class="text-white">Arcate</span>
                        </div>

                        <div class="card-body">

                          <div class="mb-3 row">
                            <label class="col-auto col-form-label">AS</label>
                            <div class="col">
                              <input id="as" class="form-control shadow-none bg-white" readonly></input>
                            </div>
                          </div>

                          <div class="row">
                            <label class="col-auto col-form-label">AI</label>
                            <div class="col">
                              <input id="ai" class="form-control shadow-none bg-white" readonly></input>
                            </div>
                          </div>

                        </div>

                      </div>
                      <!-- End arcate -->


                      <!-- Bocca -->
                      <div class="card">
                        <div class="card-header bg-info">
                          <span class="text-white">Bocca</span>
                        </div>
                        <div class="card-body px-0 pb-0 py-2">
                          <input id="bo" class="form-control border-0 shadow-none bg-white" readonly></input>
                        </div>
                      </div>
                      <!-- End Bocca -->

                    </div>

                  </div>
                  <!-- End Colonna destra (quadranti, arcate, bocca) -->

                </div>
                <!-- End ROW -->

                <!-- Table Diario -->
                <div class="row no-no-gutters mx-2 mt-4">

                  <?php if($is_dentista && !$is_cestinato) : ?>
                    <div class="mb-2">
                      <a class="btn btn-primary" data-toggle="modal" data-target="#modalRegistraTrattamento">Registra trattamento</a>
                    </div>
                  <?php endif ?>

                  <table class="table table-bordered <?php if($is_dentista && !$is_cestinato) echo "table-hover"; ?>">
                    <thead class="bg-primary text-white">
                      <!-- 
                      <colgroup>
                        <col class="col-auto" />
                        <col class="col-auto" />
                        <col class="col-auto" />
                        <col style="width: 40%;" />
                        <col class="col-auto" />
                        <col class="col-auto mr-auto" />
                        <col class="col-auto border-0" />
                      </colgroup> -->

                      <tr>
                        <th>ED</th>
                        <th>Codice</th>
                        <th>Trattamento</th>
                        <th>Note</th>
                        <th>Stato</th>
                        <th>Data</th>
                      </tr>
                    </thead>

                    <tbody>


                      <?php if ($trattamenti == null) { ?>

                        <tr>
                          <th></th>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>

                      <?php }
                      foreach ($trattamenti as $t) { ?>

                        <?php if($is_dentista && !$is_cestinato) : ?>
                        <tr id="<?php echo $t["id"]; ?>" data-toggle="modal" data-target="#modalModificaNotaOdontoiatrica" onclick="setModalModificaNotaOdontoiatrica(this)">
                        <?php else : ?>
                        <tr id="<?php echo $t["id"]; ?>">
                        <?php endif ?>
                          <td><?php echo $t["ed"]; ?></td>
                          <td><?php echo $t["codice"]; ?></td>
                          <td><?php echo $t["prestazione"]; ?></td>
                          <td><?php echo $t["note"]; ?></td>
                          <td><?php
                            switch ($t["stato"]) {
                              case "v":
                                echo ("Visita");
                                break;
                              case "e":
                                echo ("Eseguito");
                                break;
                              case "c":
                                echo ("In corso");
                                break;
                            }
                          ?></td>
                          

                          <td><?php echo (date("d-m-Y", strtotime($t["data"]))); ?></td>

                        </tr>

                      <?php } ?>

                    </tbody>
                  </table>
                </div>
                <!-- Table Diario -->

                <!-- Footer buttons -->
                <?php if(!$is_cestinato) :?>
                <div class="row mt-4">

                  <div class="col-auto ml-auto">
                    <a class="btn btn-danger mx-1" data-toggle="modal" data-target="#modalEliminaScheda">Elimina scheda</a>
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
            <?php require_once __DIR__ . "/scheda_contabilita.php"; ?>
          </div>
          <!-- End contabilità page -->

          <!-- Scheda immagini -->
          <div class="tab-pane fade <?php if (isset($_GET["immagini"])) echo ("show active") ?>" id="pills-immagini">
            <?php include __DIR__ . "/scheda_immagini.php"; ?>
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

  <!-- Modal modifica tipo prestazione -->
  <?php include_once __DIR__ . "/../modals/modal_modifica_tipo_prestazione.php"; ?>

  <!-- Including LogoutModal -->
  <?php require __DIR__ . "/../modals/logoutModal.html"; ?>

  <?php require __DIR__ . "/../footer.html"; ?>


  <!-- Modal registra trattamento -->
  <div class="modal fade" id="modalRegistraTrattamento" role="dialog" aria-labelledby="modalRegistraTrattamento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Registra trattamento</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="/business_logic/managerScheda.php?id_scheda=<?php echo ($_GET["id"]); ?>" method="POST">

          <div class="modal-body">

            <div class="form-group">
              <label class="form-label text-gray-900">ED</label>
              <input type="text" class="form-control" maxlength="2" name="ed" value="" required>
            </div>

            <div class="form-group">
              <label class="form-label text-gray-900">Prestazioni</label>
              <select class="custom-select" name="trattamento" required>
                <option class="d-none" disabled selected value=""></option>
                <?php foreach ($prestazioni as $p) { ?>
                  <option value="<?php echo ($p["id"]); ?>"><?php echo ($p["nome"]); ?></option>
                <?php } ?>
              </select>
            </div>


            <div class="form-group">
              <label class="form-label text-gray-900">Note</label>
              <input type="text" class="form-control" maxlength="255" name="note" value="">
            </div>

            <div class="form-group">
              <label class="form-label text-gray-900">Stato</label>
              <select class="custom-select" name="stato" required>
                <option value='v'>Visita</option>
                <option value='e'>Eseguito</option>
                <option value='c'>In corso</option>
              </select>
            </div>

            <div class="form-group mb-0">
              <label class="form-label text-gray-900">Data</label>
              <input type="date" class="form-control" name="data" value="<?php echo (date("Y-m-d")); ?>" required>
            </div>

            <br>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <button class="btn btn-primary" name="aggiungiNotaOdontoiatrica">Aggiungi</a>
          </div>

        </form>
      </div>
    </div>
  </div>


  <!-- Modal modifica trattamento -->
  <div class="modal fade" id="modalModificaNotaOdontoiatrica" role="dialog" aria-labelledby="modalModificaNotaOdontoiatrica" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Modifica Trattamento</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form id="modalModificaNotaOdontoiatricaForm" action="" method="POST">

          <div class="modal-body">

            <div class="form-group">
              <label class="form-label text-gray-900">ED</label>
              <input id="modalModificaNotaOdontoiatricaED" type="text" class="form-control" maxlength="2" name="ed" value="" required>
            </div>

            <div class="form-group">
              <label class="form-label text-gray-900">Trattamento</label>
              <select id="modalModificaNotaOdontoiatricaSelect" class="custom-select" name="trattamento" required>
                <option class="d-none" disabled selected value=""></option>
                <?php foreach ($prestazioni as $t) { ?>
                  <option id="codice_<?php echo ($t["codice"]); ?>" value="<?php echo ($t["id"]); ?>"><?php echo ($t["nome"]); ?></option>
                <?php } ?>
              </select>
            </div>


            <div class="form-group">
              <label class="form-label text-gray-900">Note</label>
              <input id="modalModificaNotaOdontoiatricaNote" type="text" class="form-control" maxlength="255" name="note" value="">
            </div>

            <div class="form-group">
              <label class="form-label text-gray-900">Stato</label>
              <select class="custom-select" name="stato" required>
                <option id="modalModificaNotaOdontoiatricaVisita" value='v'>Visita</option>
                <option id="modalModificaNotaOdontoiatricaEseguito" value='e'>Eseguito</option>
                <option id="modalModificaNotaOdontoiatricaInCorso" value='c'>In corso</option>
              </select>
            </div>

            <div class="form-group mb-0">
              <label class="form-label text-gray-900">Data</label>
              <input id="modalModificaNotaOdontoiatricaData" type="date" class="form-control" name="data" value="" required>
            </div>

            <br>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal" data-toggle="modal" data-target="#modalEliminaTrattamento" onclick="removeFadeModalModificaDiario()">Elimina</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <button class="btn btn-primary" name="modificaNotaOdontoiatrica">Modifica</a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Modal elimina trattamento -->
  <div class="modal" id="modalEliminaTrattamento" role="dialog" aria-labelledby="modalEliminaTrattamento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Elimina trattamento</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="modalEliminaTrattamentoText" class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <a id="modalEliminaTrattamentoButton" type="button" class="btn btn-danger" href="">Elimina</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal apri scheda -->
  <?php include __DIR__  . "/../modals/modal_open_scheda.php"; ?>

  
  <!-- Script visualizzazione diario sulla pagina -->
  <script>
    /* Colore denti */
    let colours = {
      v: "#FF0000", /* Visita (preventivato) */
      e: "#00FF00", /* Eseguito */
      c: "#FFFF00" /* In corso */
    };

    /* Definizione struttura elementi del diario */
    const diario = [

      <?php
      $first = true;
      foreach ($trattamenti as $t) {
        if (!$first) {
          echo (", ");
        } else {
          $first = false;
        }
        echo ('{ed: "' . strtolower($t["ed"]) . '", codice: "' . $t["codice"] . '", stato: "' . $t["stato"] . '"}');
      }
      ?>

    ];

    /* Inserimento degli elementi del diario nell'interfaccia */
    for (let i = diario.length - 1; i >= 0; i--) {

      let ed = diario[i]["ed"];
      let elem = document.getElementById(ed);


      /* Elemeneto non trovato */
      if (elem == null) continue;

      if (elem.value == "") {
        elem.value = diario[i]["codice"];
      } else {
        elem.value += " + " + diario[i]["codice"];
      }

      /* Se è un dente, cambio colore in base allo stato */
      if (!isNaN(ed)) {

        let stato = diario[i]["stato"];
        let dente = document.getElementById("dent" + ed);

        /* Se il dente è rosso, non è possibile cambiare colore per quel dente*/
        if (dente.style.backgroundColor.toString() != "rgb(255, 0, 0)") {

          /* Se il dette non è rosso ma è giallo, non si può cambiare colore. Se non è giallo, si può cambiare. */
          if (dente.style.backgroundColor.toString() != "rgb(255, 255, 0)") {
            dente.style.backgroundColor = colours[stato];
          }
        }
      }
    }
  </script>


  <script>
    /* MODAL MODIFICA TRATTAMENTO */
    function setModalModificaNotaOdontoiatrica(row) {

      /* Ripristino fade modal modifica trattamento */
      let modal = document.getElementById("modalModificaNotaOdontoiatrica");
      modal.classList.add("fade");


      /* Gets element from diario */
      let rowElements = row.getElementsByTagName("td");
      let id_nota = row.id;
      let ed = rowElements[0].innerHTML;
      let codice = rowElements[1].innerHTML;
      let note = rowElements[3].innerHTML;
      let stato = rowElements[4].innerHTML;
      let data = rowElements[5].innerHTML;

      let form_action = document.getElementById("modalModificaNotaOdontoiatricaForm").getAttribute("action");

      /* Modifica elementi del modal */
      document.getElementById("modalModificaNotaOdontoiatricaED").value = ed;
      document.getElementById("modalModificaNotaOdontoiatricaNote").value = note;
      document.getElementById("modalModificaNotaOdontoiatricaData").value = data.substr(6) + "-" + data.substr(3, 2) + "-" + data.substr(0, 2);

      let modalForm = document.getElementById("modalModificaNotaOdontoiatricaForm");
      let action = "/business_logic/managerScheda.php?id_scheda=<?php echo ($_GET["id"]); ?>&id_nota=" + id_nota;
      modalForm.setAttribute("action", action);

      /* Selezione del tratamento in base al codice */
      let modalSelectOptions = document.getElementById("modalModificaNotaOdontoiatricaSelect").getElementsByTagName("option");

      for (option of modalSelectOptions) {

        let id = option.id.substr(7).toLowerCase();

        if (id != codice.toLowerCase()) {
          option.removeAttribute("selected");
        } else {
          option.setAttribute("selected", "");
        }

      }

      /* Modifica dello stato del modal */
      switch(stato) {
        
        case "Visita":
          document.getElementById("modalModificaNotaOdontoiatricaVisita").setAttribute("selected", "");
          break;

        case "In corso":
          document.getElementById("modalModificaNotaOdontoiatricaInCorso").setAttribute("selected", "");
          break;
        case "Eseguito":
          document.getElementById("modalModificaNotaOdontoiatricaEseguito").setAttribute("selected", "");
          break;
      }

      /* Set modal elimina trattamento */
      setModalEliminaTrattamento(row);
    }


    /* MODAL ELIMINA TRATTAMENTO */
    function setModalEliminaTrattamento(row) {

      /* Get elements */
      let rowElements = row.getElementsByTagName("td");
      let id_nota = row.id;
      let trattamento = rowElements[2].innerHTML;
      let data = rowElements[5].innerHTML;
      let text = "Sei sicuro di voler eliminare il trattamento <b>" + trattamento + "</b> del <b>" + data + "</b>?<br>Una volta eliminato non sarà più possibile recuperarlo.";
      let button = document.getElementById("modalEliminaTrattamentoButton");

      /* Modifica testo all'interno del modal */
      document.getElementById("modalEliminaTrattamentoText").innerHTML = text;

      /* Modifica testo action del button elimina */
      let href = "/business_logic/managerScheda.php?id_scheda=<?php echo ($_GET["id"]); ?>&id_nota=" + id_nota + "&action=deleteNotaOdontoiatrica";
      button.setAttribute("href", href);



    }

    /* Rimozione fade modal modifica trattamento */
    function removeFadeModalModificaDiario() {

      let modal = document.getElementById("modalModificaNotaOdontoiatrica");
      modal.classList.remove("fade");

    }
  </script>

  <!-- Script per visualizzare il nome dell'immagine caricata  -->
  <script type="text/javascript" src="/presentation/dynamic_interactions_ui/uploadImage.js"></script>

  <!-- Functions generali scheda -->
  <script type="text/javascript" src="/presentation/dynamic_interactions_ui/functions_scheda.js"></script>

</body>

</html>