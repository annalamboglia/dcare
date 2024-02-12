<!DOCTYPE html>
<html lang="it">

<head>


  <?php

  require  __DIR__ . "/../../business_logic/permissionManager.php";
  require_once __DIR__ . "/../header.html";

  // Data di cui visualizzare la settimana
  $data = isset($_GET["data"]) ? $_GET["data"] : Date("Y-m-d");


  // Giorni della settima
  $dayOfWeek = idate('w', strtotime($data));
  $week[$dayOfWeek] = $data;

  for ($i = $dayOfWeek - 1; $i >= 0; $i--) {
    $week[$i] = date("Y-m-d", strtotime($week[$i + 1] . " -1 day"));
  }
  for ($i = $dayOfWeek + 1; $i <= 6; $i++) {
    $week[$i] = date("Y-m-d", strtotime($week[$i - 1] . " +1 day"));
  }

  // Get appuntamenti della settimana
  require_once __DIR__ . "/../../data_access/dao/AppuntamentoDAO.php";
  for ($i = 1; $i <= 6; $i++) {
    $appuntamentiDelGiorno[$i] = $appuntamentoDAO->getAppuntamenti($week[$i]);
  }

  ?>


  <title>Dcare: Calendario</title>


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
      <div class="container-fluid mr-3">

        <!-- Riga intestazione -->
        <div class="row no-gutters">

          <div class="form-inline form-group">

            <span class="mr-4">Data:</span>
            <input id="input_data" name="data" class="form-control" type="date" value="<?php echo $data; ?>" onchange="window.location = 'calendario.php?data=' + this.value;"></input>

          </div>

          <div class="ml-auto">
            <div class="btn btn-primary" data-target="#modalAggiungiAppuntamento" data-toggle="modal" onclick="setModalAggiungiAppuntamento(null)">Aggiungi appuntamento</div>
          </div>
        </div>
        <!-- End riga intestazione -->

        <!-- Box Calendario -->
        <div class="px-0 overflow-auto shadow border" style="height: 80vh;">

          <table class="table border-0 p-0 m-0 text-center">

            <thead>

              <colgroup>
                <col class="col-auto border-right" />
                <col class="col-auto border-right" />
                <col class="col-auto border-right" />
                <col class="col-auto border-right" />
                <col class="col-auto border-right" />
                <col class="col-auto border-right" />
                <col class="col-auto border-right" />
              </colgroup>

              <tr class="bg-primary text-white" style="position: sticky; top: 0; font-size: 12px;">
                <th></th>
                <th>Lunedì <?php echo "<br>" . date("d-m-Y", strtotime($week[1])); ?></th>
                <th>Martedì <?php echo "<br>" . date("d-m-Y", strtotime($week[2])); ?></th>
                <th>Mercoledì <?php echo "<br>" . date("d-m-Y", strtotime($week[3])); ?></th>
                <th>Giovedì <?php echo "<br>" . date("d-m-Y", strtotime($week[4])); ?></th>
                <th>Venerdì <?php echo "<br>" . date("d-m-Y", strtotime($week[5])); ?></th>
                <th>Sabato <?php echo "<br>" . date("d-m-Y", strtotime($week[6])); ?></th>
              </tr>
            </thead>
            <tbody>

              <!-- For su tutti gli orari -->
              <?php
              $i = 8;
              $minuti = "00";
              while ($i <= 21) { ?>

                <!-- Inizio riga orario i-esimo -->
                <tr style="font-size: 14px;">

                  <!-- Intestazione (stampa orario i-esimo) -->
                  <th class="align-middle p-2"><?php echo "$i:$minuti" ?></th>

                  <!-- Controllare appuntamenti in tutta la settimana nell'orario i-esimo -->
                  <?php for ($day = 1; $day <= 6; $day++) { ?>

                    <!-- Cella orario i e giorno day -->
                    <td class="p-0">
                      <div class="d-flex flex-column text-left h-100">

                        <!-- Plus button add prenotazione -->
                        <div class="flex-grow-1 order-1 calendar-add" data-toggle="modal" data-target="#modalAggiungiAppuntamento" onclick="setModalAggiungiAppuntamento(this)">
                          <div class="d-none"><?php echo $week[$day] ?></div>
                          <div class="d-none"><?php echo "$i:$minuti" ?></div>
                        </div>

                        <?php

                        /* 
                         * Check se sono presenti appuntamenti in quella data 
                         * Se non è presente un appuntamneto in quella cella, si passa alla prossima chiudendo correttamente la cella (div e td)
                        */
                        if ($appuntamentiDelGiorno[$day] == NULL) {
                          echo "</div></td>";
                          continue;
                        }

                        /* 
                         * Controllo di tutti gi appuntamenti del giorno day
                         * Se un appuntamento di quel giorno va inserito in quell'orario, stampa appuntamento
                        */
                        foreach ($appuntamentiDelGiorno[$day] as $appuntamento) {

                          $ora_appuntamento = intval(substr($appuntamento["datatime"], 11, 2));
                          $minuti_appuntamento = intval(substr($appuntamento["datatime"], 14, 2));

                          if ($ora_appuntamento == $i && $minuti_appuntamento == intval($minuti)) {
                        ?>
                            <div class="py-0 pl-2 py-2 border-bottom row-hover order-0" data-toggle="modal" data-target="#modalModificaAppuntamento" onclick="setModalModificaAppuntamento(this)">
                              <span><?php echo $appuntamento["nome"] . " " . $appuntamento["cognome"]; ?></span>
                              <span class="d-none"><?php echo $appuntamento["id"]; ?></span>
                              <span class="d-none"><?php echo $appuntamento["nome"]; ?></span>
                              <span class="d-none"><?php echo $appuntamento["cognome"]; ?></span>
                              <span class="d-none"><?php echo $appuntamento["datatime"]; ?></span>
                              <span class="d-none"><?php echo $appuntamento["note"]; ?></span>
                            </div>
                        <?php
                          } /* Chiusura IF */
                        } /* Chiusura FOREACH (appuntamenti della giornata day) */
                        ?>

                      </div>
                    </td>
                    <!-- End cella orario i e giorno day -->
                  <?php
                  }
                  ?>
                </tr>
                <!-- Fine riga orario i-esimo -->

              <?php
                $i = $minuti == "30" ? $i + 1 : $i;
                $minuti = $minuti == "30" ? "00" : "30";
              }
              ?>
              <!-- END for su tutti gli orari -->

            </tbody>
          </table>

        </div>
        <!-- End Box Calendario -->

      </div>
      <!-- end main page -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->


  <!-- Modal aggiungi appuntamento -->
  <div class="modal fade" id="modalAggiungiAppuntamento" tabindex="-1" role="dialog" aria-labelledby="modalAggiungiAppuntamento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Aggiungi appuntamento</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            
          <form action="/../../business_logic/managerAppuntamenti.php?data=<?php echo $data; ?>" method="POST">

            <div class="modal-body">

              <div class="form-group">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" maxlength="15" required>
              </div>

              <div class="form-group">
                <label class="form-label">Cognome</label>
                <input type="text" class="form-control" name="cognome" maxlength="20" required>
              </div>

              <div class="form-group">
                <label class="form-label">Data</label>
                <input id="modalAggiungAppuntamentoDada" type="datetime-local" class="form-control" name="datetime" min="2000-01-01T00:00" value="" required>
              </div>

              <div class="form-group">
                <label class="form-label">Note</label>
                <textarea class="form-control" name="note" maxlength="100"></textarea>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
              <button type="submit" class="btn btn-primary" name="aggiungiAppuntamento">Aggiungi</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- End modal aggiungi appuntamento -->

  <!-- Modal modifica appuntamento -->
  <div class="modal fade" id="modalModificaAppuntamento" tabindex="-1" role="dialog" aria-labelledby="modalModificaAppuntamento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Modifica appuntamento</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form id="modificaAppuntamentoForm" action="" method="POST">

            <div class="modal-body">

              <div class="form-group">
                <label class="form-label">Nome</label>
                <input id="modificaAppuntamentoNome" type="text" class="form-control" name="nome" maxlength="15" required>
              </div>

              <div class="form-group">
                <label class="form-label">Cognome</label>
                <input id="modificaAppuntamentoCognome" type="text" class="form-control" name="cognome" maxlength="20" required>
              </div>

              <div class="form-group">
                <label class="form-label">Data</label>
                <input id="modificaAppuntamentoData" type="datetime-local" class="form-control" name="datetime" min="2000-01-01T00:00" value="<?php echo Date("Y-m-d") . "T08:00"; ?>" required>
              </div>

              <div class="form-group">
                <label class="form-label">Note</label>
                <textarea id="modificaAppuntamentoNote" class="form-control" name="note" maxlength="100"></textarea>
              </div>

            </div>

            <div class="modal-footer">
              <a id="modificaAppuntamentoEliminaBtn" class="btn btn-danger mr-auto" href="">Elimina</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
              <button type="submit" class="btn btn-primary" name="modificaAppuntamento">Modifica</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- End modal modifica appuntamento -->

  <script>

    /* Funzione set modal modifica appumento */
    function setModalModificaAppuntamento(cell) {

      /* Get modal elements */
      let modalNome = document.getElementById("modificaAppuntamentoNome");
      let modalCognome = document.getElementById("modificaAppuntamentoCognome");
      let modalData = document.getElementById("modificaAppuntamentoData");
      let modalNote = document.getElementById("modificaAppuntamentoNote");
      let modalForm = document.getElementById("modificaAppuntamentoForm");
      let eliminaBtn = document.getElementById("modificaAppuntamentoEliminaBtn");


      /* Get data */
      let cellElements = cell.getElementsByTagName("span");
      let id = cellElements[1].innerHTML;
      let nome = cellElements[2].innerHTML;
      let cognome = cellElements[3].innerHTML;
      let data = cellElements[4].innerHTML;
      let note = cellElements[5].innerHTML;
      let action = "/../../business_logic/managerAppuntamenti.php?id=" + id + "&data=<?php echo $data; ?>";
      let href = "/../../business_logic/managerAppuntamenti.php?action=eliminaAppuntamento&id=" + id + "&data=<?php echo $data; ?>";

      /* Set modal elements */
      modalNome.value = nome;
      modalCognome.value = cognome;
      modalData.value = data.replace(" ", 'T');
      modalNote.value = note;
      modalForm.action = action;
      eliminaBtn.href = href;

    }


    /* Set del modal aggiungi appuntamento */
    function setModalAggiungiAppuntamento(td) {

      let dataInput = document.getElementById("modalAggiungAppuntamentoDada");

      /* Se è stato premuto su una casella, imposta data e ora della casella */
      if (td != null) {
        let elements = td.getElementsByTagName("div");
        let day = elements[0].innerHTML;
        let time = elements[1].innerHTML;
        if (time.search(':') == 1)
          time = "0" + time;
        dataInput.setAttribute("value", day + "T" + time);
      } 

      /* Se si sta aggiungendo l'appuntamento da "Aggiungi Appuntamento", imposta data odierna */
      else {
        dataInput.setAttribute("value", "<?php echo Date("Y-m-d") . "T08:00"; ?>");
      }

    }


    /* Set dell'altezza delle celle */
    window.onload = function() {
      let tag = document.getElementsByTagName("td");
      for (t of tag) {
        t.setAttribute("style", "height: " + t.offsetHeight + "px");
      }
    };
    
  </script>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Including LogoutModal -->
  <?php require __DIR__ . "/../../presentation/modals/logoutModal.html"?>

  <?php require __DIR__ . "/../footer.html" ?>

</body>

</html>