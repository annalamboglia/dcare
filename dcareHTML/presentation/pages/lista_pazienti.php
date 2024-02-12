<!DOCTYPE html>
<html lang="it">

<head>

  <?php
  require __DIR__ . "/../../business_logic/permissionManager.php";
  require_once __DIR__ . "/../header.html";

  //Recupero informazioni pazienti
  require_once __DIR__ . "/../../data_access/dao/PazienteDAO.php";

  if (isset($_GET["cestino"])) {
    $pazienti = $pazienteDAO->getPazientiCestinati();
    $title = "Dcare: Cestino";
  } else {
    $title = "Dcare: Lista pazienti";
    $pazienti = $pazienteDAO->getPazientiNoCestinati();
  }

  ?>


  <title><?php echo ($title) ?></title>


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
      <div class="container-fluid">

        <!-- Cartella Header -->
        <div class="d-flex flex-row">

          <?php if (!isset($_GET["cestino"])) { ?>

            <h3 class="flex-grow-1 m-3">Pazienti</h3>
            <a class="btn btn-primary mr-0 my-3" href="dati_paziente.php" role="button">Aggiungi Paziente</a>

          <?php } else { ?>
            <h3 class="flex-grow-1 m-3">Cestino</h3>
            <a class="btn btn-danger mr-0 my-3" data-toggle="modal" data-target="#modalSvuotaCestino" role="button">Svuota cestino</a>
          <?php } ?>

        </div>
        <!-- End cartella header -->

        <!-- Table Card -->
        <div class="card shadow mb-4">


          <!-- Table Card Body -->
          <div class="card-body">

            <div class="table-responsive col-12">


              <!-- Top table -->
              <div class="row mb-3">
                <div class="col-sm-6 col-lg-4">
                  <input type="search" id="inputSearch" class="form-control" placeholder="Search" oninput="searchPaziente(); setTable('dataTable', 1);">
                </div>
              </div>

              <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                <!-- End top table -->
                <!-- Intestazione tabella -->
                <thead>
                  <tr class="bg-primary text-white">
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th>Data di nascita</th>
                    <th>Telefono</th>
                    <th>E-Mail</th>
                  </tr>
                </thead>


                <!-- Table Body -->
                <tbody>

                  <!-- Stampa lista dei pazienti -->
                  <?php
                  foreach ($pazienti as $p) { ?>

                    <tr style="cursor: pointer">

                      <td onclick='viewCartellaClinicaPaziente(<?php echo $p["id"]; ?>)'><?php echo ($p["cognome"]); ?></td>
                      <td onclick='viewCartellaClinicaPaziente(<?php echo $p["id"]; ?>)'><?php echo ($p["nome"]); ?></td>
                      <td onclick='viewCartellaClinicaPaziente(<?php echo $p["id"]; ?>)'>
                        <?php
                        if ($p["dataNascita"] == null) {
                          echo ("N/A");
                        } else {
                          echo (date("d-m-Y", strtotime($p["dataNascita"])));
                        }
                        ?>
                      </td>
                      <td onclick='viewCartellaClinicaPaziente(<?php echo $p["id"]; ?>)'><?php echo ($p["telefono"]); ?></td>
                      <td onclick='viewCartellaClinicaPaziente(<?php echo $p["id"]; ?>)'><?php echo ($p["email"]); ?></td>

                      <?php if (isset($_GET["cestino"])) { ?>
                        <td class="border-0" style="width: 1%; background-color: white;">
                          <a class="fas fa-trash text-decoration-none" data-toggle="modal" data-target="#modalEliminazioneDefinitiva" onclick='modalSetParameter(<?php echo ($p["id"]) ?>, "<?php echo ($p["nome"]) ?>", "<?php echo ($p["cognome"]) ?>")'></a>
                        </td>
                      <?php } ?>

                    </tr>

                  <?php } ?>
                  <!-- End Stampa lista pazienti -->



                </tbody>
                <!-- End Table body -->
              </table>


              <!-- Page bar -->
              <div class="row justify-content-end">
                <nav>
                  <ul class="pagination">
                    <li class="page-item">
                      <a id="previousButton" class="page-link table-pages-button" onclick="setTable('dataTable',1)">Previous</a>
                    </li>
                    <li id="firstPageButton" class="page-item active table-pages-button"><a class="page-link select" onclick="setTable('dataTable',1)">1</a></li>
                    <li id="secondPageButton" class="page-item table-pages-button"><a class="page-link" onclick="setTable('dataTable',2)">2</a></li>
                    <li id="thirdPageButton" class="page-item table-pages-button"><a class="page-link" onclick="setTable('dataTable',3)">3</a></li>
                    <li class="page-item">
                      <a id="nextButton" class="page-link table-pages-button" onclick="setTable('dataTable',2)">Next</a>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- End page bar -->

            </div>
            <!-- End table responsive -->

          </div>
          <!-- End Table Card Body -->

        </div>
        <!-- End Table Card -->

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




  <?php if (isset($_GET["cestino"])) { ?>

    <!-- Modal conferma eliminazione -->
    <div class="modal fade" id="modalEliminazioneDefinitiva" role="dialog" aria-labelledby="modalEliminazioneDefinitiva" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title text-white">Elimina Paziente</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modalConfermaEliminazioneText" class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <a id="modalConfermaEliminazioneButton" type="button" class="btn btn-danger" href="">Elimina</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal svuota cestino -->
    <div class="modal fade" id="modalSvuotaCestino" role="dialog" aria-labelledby="modalSvuotaCestino" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title text-white">Svuota cestino</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Sei sicuro di voler svuotare il cestino?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <a id="modalButtonElimina" type="button" class="btn btn-danger" href="/business_logic/managerPazienti.php/?action=svuotaCestino">Svuota</a>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

  <!-- Including LogoutModal -->
  <?php require __DIR__ . "/../modals/logoutModal.html" ?>

  <?php require __DIR__ . "/../footer.html" ?>

  <!-- SCRIPT SEARCHPAZIENTE -->
  <script>
    var visible_elements = document.getElementById("dataTable").getElementsByTagName("tr");
    visible_elements = Array.prototype.slice.call(visible_elements, 1);
  </script>
  <script src="/presentation/dynamic_interactions_ui/searchPaziente.js"></script>
  <?php require __DIR__ . "/../dynamic_interactions_ui/tablePages.php"; ?>



  <!-- Script per la modifica del modal dell'eliminazione -->
  <script>
    function modalSetParameter(id, nome, cognome) {

      let text = "Sei sicuro di voler eliminare definitivamente il paziente <b>:nomePaziente :cognomePaziente</b>?<br>Non sarà più possibile ripristinare il paziente.";
      text = text.replace(":nomePaziente", nome);
      text = text.replace(":cognomePaziente", cognome);

      let modalConfermaEliminazioneText = document.getElementById("modalConfermaEliminazioneText");
      modalConfermaEliminazioneText.innerHTML = text;

      let buttonElimina = document.getElementById("modalConfermaEliminazioneButton");
      let href = "/business_logic/managerPazienti.php?id=:id&action=eliminaPaziente";
      href = href.replace(":id", id);
      buttonElimina.setAttribute("href", href);

    }
  </script>

  <!-- Script per visualizzare la pagina di un utente onclick row table -->
  <script>
    function viewCartellaClinicaPaziente(id) {
      if (window.getSelection().toString().length === 0)
        window.location = "./cartella_clinica.php?id=" + id;
    }
  </script>



</body>




</html>