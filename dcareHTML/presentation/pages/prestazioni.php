<!DOCTYPE html>
<html lang="it">

<head>

    <?php
    require_once __DIR__ . "/../../business_logic/permissionManager.php";
    require_once __DIR__ . "/../header.html";
    require_once __DIR__ . "/../../data_access/dao//PrezzoDAO.php";


    /* Caricamento prestazioni */
    require_once __DIR__ . "/../../data_access/dao/PrestazioneDAO.php";

    $prestazioni = $prestazioneDAO->getPrestazioni();
    $listino = $prezzoDAO->getListino();

    ?>

    <!-- Allert simbol -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>


    <title>Dcare: Prestazioni</title>


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
            <div class="row mx-3 h-100">

                <!-- Prestazioni -->
                <div class="col-12 col-md-4" style="height: 85vh;">
                    <div class="card h-100">

                        <h4 class="card-header bg-primary text-center text-white">Prestazioni</h4>

                        <div class="card-body px-0 py-1 h-100">

                            <!-- Tabella dei prestazioni -->
                            <div class="overflow-auto h-100">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-white" style="position: sticky; top: 0;">
                                            <th scope="col" class="border-top-0">Codice</th>
                                            <th scope="col" class="border-top-0">Prestazione</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($prestazioni as $t) : ?>
                                            <tr id="Prestazione_<?php echo ($t["id"]); ?>" class="row-hover" data-toggle="modal" data-target="#modalModificaPrestazione" onclick='setModalModificaPrestazione(<?php echo ($t["id"]); ?>)'>
                                                <td><?php echo ($t["codice"]); ?></td>
                                                <td><?php echo ($t["nome"]); ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- End body card prestazioni -->

                        <!-- End table prestazioni -->
                        <div class="card-footer bg-transparent text-truncate text-right pb-3">
                            <div class="btn btn-primary " data-toggle="modal" data-target="#modalAggiungiPrestazione">Aggiungi Prestazione</div>
                        </div>
                    </div>
                </div>
                <!-- End card prestazioni -->

                <!-- Prezzario -->
                <div class="col-12 col-md-4 mt-2 mt-md-0" style="height: 85vh;">

                    <!-- Begin card prezzario -->
                    <div class="card h-100">

                        <h4 class="card-header bg-primary text-center text-white">Prezzario</h4>

                        <div class="card-body px-0 py-1 h-100">

                            <!-- Tabella prezzario -->
                            <div class="overflow-auto h-100">

                                <table id="tabellaPrezzi" class="table table-hover">
                                    <thead>
                                        <tr class="bg-white" style="position: sticky; top: 0;">
                                            <th scope="col" class="border-top-0">Codice</th>
                                            <th scope="col" class="border-top-0">Prestazione</th>
                                            <th scope="col" class="border-top-0">Prezzo</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <!-- Riempimento tabella con i prezzi -->
                                        <?php foreach ($prestazioni as $t) : ?>

                                            <tr class="row-hover" onclick="<?php echo ("showCrono('" . $t["codice"] . "')"); ?>, setRowClicked(this.style)">
                                                <td><?php echo ($t["codice"]); ?></td>
                                                <td><?php echo ($t["nome"]); ?></td>
                                                <td>
                                                    <?php
                                                    $prezzo = $prezzoDAO->getPrezzoByData($t["id"], date("Y-m-d"));

                                                    if ($prezzo != 0) echo ($prezzo . "€");
                                                    else echo ("N.A.");
                                                    ?>
                                                </td>

                                            </tr>

                                        <?php endforeach ?>
                                        <!-- End riempimento tabella coi prezzi -->

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-6">
                                    <input id="input_data" class="form-control" type="date" value="<?php echo (date("Y-m-d")); ?>" oninput="setPrezzario(this.value)"></input>
                                </div>
                                <div class="col-6 text-truncate text-right">
                                    <div class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalAggiungiPrezzo">Aggiungi prezzo</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End card prezzario -->
                </div>
                <!-- End prezzario -->

                <!-- Begin cronologia  -->
                <div class="col-12 col-md-4 mt-2 mt-md-0" style="height: 85vh;">

                    <div class="card h-100">

                        <h4 class="card-header bg-primary text-white text-center">Cronologia Prestazione</h4>

                        <div class="card-body px-0 py-1 h-100">

                            <!-- Tabella cronologia -->
                            <div id="crono_table" class="overflow-auto d-none h-100">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-white" style="position: sticky; top: 0;">
                                            <th scope="col" class="border-top-0">Prezzo</th>
                                            <th scope="col" class="border-top-0">Data</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($listino as $l) :
                                            if (!isset($l['id_prezzo'])) continue;
                                        ?>
                                            <tr class="row-hover" style="display: none" data-toggle="modal" data-target="#modalModificaPrezzo" onclick="setModalModificaPrezzo(this, <?php echo ($l['id_prezzo']); ?>)">
                                                <td><?php echo ($l['valore'] . '€'); ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($l['data'])); ?></td>
                                                <td class="d-none"><?php echo ($l['codice']); ?></td>
                                            </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                </table>
                            </div>

                            <div id="crono_empty" class="d-flex flex-column h-100 align-items-center justify-content-center">
                                <span class="far fa-folder fa-9x"></span>
                                <h4 class="text-center"><strong>Selezionare una prestazione</strong></h4>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End cronologia -->



            </div>
            <!-- end main page -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal aggiungi Prestazione -->
    <div class="modal fade" id="modalAggiungiPrestazione" tabindex="-1" role="dialog" aria-labelledby="modalAggiungiPrestazione" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Aggiungi Prestazione</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div id="error_message" class="alert alert-danger d-flex align-items-center mb-0" style="display: none !important;">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div class="ml-2">
                            Errore: codice Prestazione già esistente!
                        </div>
                    </div>

                    <form action="/business_logic/managerPrestazioni.php" onsubmit="return validaCodice('form_codice', 'error_message')" method="POST">

                        <div class="modal-body">

                            <div class="form-group">
                                <label class="form-label text-gray-900">Codice</label>
                                <input id="form_codice" type="text" class="form-control text-uppercase" maxlength="10" name="codice" value="" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label text-gray-900">Nome Prestazione</label>
                                <input type="text" class="form-control" maxlength="50" name="nome" value="" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <button type="submit" class="btn btn-primary" name="aggiungiPrestazione">Aggiungi</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End modal aggiungi Prestazione -->


    <!-- Modal modifica Prestazione -->
    <div class="modal fade" id="modalModificaPrestazione" tabindex="-1" role="dialog" aria-labelledby="modalModificaPrestazione" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Modifica Prestazione</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div id="error_message_modifica" class="alert alert-danger d-flex align-items-center mb-0" style="display: none !important;">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div class="ml-2">
                            Errore: codice Prestazione già esistente!
                        </div>
                    </div>

                    <form id="modalModificaPrestazioneAction" action="" onsubmit="return validaCodice('modalModificaPrestazioneCodice', 'error_message_modifica')" method="POST">

                        <div class="modal-body">

                            <div class="form-group">
                                <label class="form-label text-gray-900">Codice</label>
                                <input id="modalModificaPrestazioneCodice" type="text" class="form-control text-uppercase" maxlength="10" name="codice" value="" required>
                                <span id="codiceOldValue" class="d-none"></span> <!-- Old value of codice -->
                            </div>

                            <div class="form-group">
                                <label class="form-label text-gray-900">Nome Prestazione</label>
                                <input id="modalModificaPrestazioneNome" type="text" class="form-control" maxlength="50" name="nome" value="" required>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button id="modalModificaPrestazioneBtnElimina" type="button" class="btn btn-danger mr-auto" data-dismiss="modal" data-toggle="modal" data-target="#modalEliminaPrestazione" onclick="">Elimina</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <button class="btn btn-primary" name="modificaPrestazione">Modifica</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End modal modifica Prestazione -->

    <!-- Modal elimina Prestazione -->
    <div class="modal" id="modalEliminaPrestazione" role="dialog" aria-labelledby="modalEliminaPrestazione" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Elimina Prestazione</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modalEliminaPrestazioneText" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <a id="modalEliminaPrestazioneButton" type="button" class="btn btn-danger" href="">Elimina</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal elimina Prestazione -->


    <!-- Modal aggiungi prezzo -->
    <div class="modal fade" id="modalAggiungiPrezzo" tabindex="-1" role="dialog" aria-labelledby="modalAggiungiPrezzo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Aggiungi prezzo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form action="/business_logic/managerPrestazioni.php" method="POST">

                        <div class="modal-body">

                            <div class="form-group">
                                <label class="form-label">Codice</label>
                                <select class="custom-select" name="prestazione" required>
                                    <option class="d-none" disabled selected value=""></option>
                                    <?php foreach ($prestazioni as $t) { ?>
                                        <option value="<?php echo ($t["id"]); ?>"><?php echo ($t["codice"]); ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Prezzo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <input type="number" class="form-control" name="prezzo" min="0" max="999999.99" step=".01" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Data</label>
                                <input id="listinoDate" type="date" class="form-control" name="data" value="<?php echo (date("Y-m-d")); ?>" required>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <button type="submit" class="btn btn-primary" name="aggiungiPrezzo">Aggiungi</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End modal aggiungi prezzo -->

    <!-- Modal modifica prezzo -->
    <div class="modal fade" id="modalModificaPrezzo" tabindex="-1" role="dialog" aria-labelledby="modalModificaPrezzo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Modifica prezzo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form id="modalFormModificaPrezzo" action="" method="POST">

                        <div class="modal-body">

                            <div class="form-group">
                                <label class="form-label">Codice</label>
                                <input id="modalModificaPrezzoCodice" type="text" class="form-control bg-white" name="codice" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Prezzo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <input id="modalModificaPrezzoPrezzo" type="number" class="form-control" name="prezzo" min="0" max="999999.99" step=".01" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Data</label>
                                <input id="modalModificaPrezzoData" type="date" class="form-control" name="data" value="" required>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button id="modalModificaPrezzoEliminaButton" type="button" class="btn btn-danger mr-auto" data-dismiss="modal" data-toggle="modal" data-target="#modalEliminaPrezzo" onclick="">Elimina</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                            <button class="btn btn-primary" name="modificaPrezzo">Modifica</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End modal modifica prezzo -->


    <!-- Modal elimina prezzo -->
    <div class="modal" id="modalEliminaPrezzo" role="dialog" aria-labelledby="modalEliminaPrezzo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Elimina prezzo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modalEliminaPrezzoText" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <a id="modalEliminaPrezzoButton" type="button" class="btn btn-danger" href="">Elimina</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal elimina prezzo -->

    <!-- Script valida codice -->
    <script>
        function validaCodice(input_codice, id_banner) {

            <?php $codici = array_column($prestazioni, "codice");  ?>
            const codici = <?php echo json_encode($codici) ?>;

            let codice_inserito = document.getElementById(input_codice).value.toUpperCase();

            /* Get del vecchio valore codice (se cambiato, altrimenti è lo stesso di codice_inserito) */
            let old_codice = document.getElementById("codiceOldValue").innerHTML;

            if (old_codice != codice_inserito && codici.includes(codice_inserito)) {
                let banner = document.getElementById(id_banner);
                banner.style.display = "";
                return false;
            } else {
                return true;
            }

        }
    </script>

    <script>
        /* Funzione per il settaggio del modal modifica Prestazione  */
        function setModalModificaPrestazione(id_prestazione) {

            /* Inserimento comparsa fade del modal */
            let modal = document.getElementById("modalModificaPrestazione");
            modal.classList.add("fade");

            /* Disabilita del banner errore */
            let banner = document.getElementById("error_message_modifica");
            banner.style.cssText = "display: none !important";


            /* Get dei valori da inserire nel modal */
            let row = document.getElementById("Prestazione_" + id_prestazione);
            let values = row.getElementsByTagName("td");

            let codice = values[0].innerHTML;
            let nome = values[1].innerHTML;

            /* Set del valore corrente del codice */
            document.getElementById("codiceOldValue").innerHTML = codice;

            /* Se dell'action */
            let action = "/business_logic/managerPrestazioni.php?id_prestazione=" + id_prestazione;
            document.getElementById("modalModificaPrestazioneAction").action = action;

            /* Set del codice */
            document.getElementById("modalModificaPrestazioneCodice").value = codice;

            /* Set del nome del Prestazione */
            document.getElementById("modalModificaPrestazioneNome").value = nome;


            let buttonElimina = document.getElementById("modalModificaPrestazioneBtnElimina");
            let onclick = "setModalEliminaPrestazione( + " + id_prestazione + ")";
            buttonElimina.setAttribute("onclick", onclick);
        }


        /* Funzione per il settaggio del modal elimina Prestazione */
        function setModalEliminaPrestazione(id_prestazione) {

            let modalModificaPrestazione = document.getElementById("modalModificaPrestazione");
            modalModificaPrestazione.classList.remove("fade");

            /* Get dei valori da inserire nel modal */
            let row = document.getElementById("Prestazione_" + id_prestazione);
            let values = row.getElementsByTagName("td");

            let codice = values[0].innerHTML;
            let nome = values[1].innerHTML;

            /* Set del testo del modal */
            let modalBody = document.getElementById("modalEliminaPrestazioneText");
            let text = "Sei sicuro di voler eliminare il Prestazione <b> " + codice + " " + nome + "</b>?<br>Una volta eliminato non sarà più possibile recuperarlo.";
            modalBody.innerHTML = text;

            /* Set href modal */
            let button = document.getElementById("modalEliminaPrestazioneButton");
            let href = "/business_logic/managerPrestazioni.php?id_prestazione=" + id_prestazione + "&action=eliminaPrestazione";
            button.setAttribute("href", href);

        }

        /* Funzione per il settaggio del modal modifca prezzo */
        function setModalModificaPrezzo(rowSelected, id_prezzo) {

            /* Inserimento comparsa fade del modal */
            let modal = document.getElementById("modalModificaPrezzo");
            modal.classList.add("fade");

            /* Get valori correnti coi quali settare il modal*/
            let cells = rowSelected.getElementsByTagName("td");
            let prezzo = cells[0].innerHTML.replace('€', '');
            let data = cells[1].innerHTML.split('-');
            data = data[2] + "-" + data[1] + "-" + data[0];
            let codice = cells[2].innerHTML;
            let action = "/business_logic/managerPrestazioni.php?id_prezzo=" + id_prezzo;
            let onclickElimina = 'setModalEliminaPrezzo("' + id_prezzo + '","' + codice + '","' + prezzo + '€","' + data + '")';

            /* Get elementi del modal */
            let modalCodice = document.getElementById("modalModificaPrezzoCodice");
            let modalPrezzo = document.getElementById("modalModificaPrezzoPrezzo");
            let modalData = document.getElementById("modalModificaPrezzoData");
            let modalForm = document.getElementById("modalFormModificaPrezzo");
            let modalEliminaBtn = document.getElementById("modalModificaPrezzoEliminaButton");

            /* Set degli elementi nel modal */
            modalCodice.value = codice;
            modalPrezzo.value = prezzo;
            console.log(data);
            modalData.value = data;
            modalForm.action = action;
            modalEliminaBtn.setAttribute("onclick", onclickElimina);

        }

        /* Funzione per il settaggio del modal elimina prezzo */
        function setModalEliminaPrezzo(id_prezzo, codice, prezzo, data) {

            /* Rimozione scomparsa fade modal precedente */
            let modalModificaPrezzo = document.getElementById("modalModificaPrezzo");
            modalModificaPrezzo.classList.remove("fade");

            /* Set del testo del modal */
            let modalBody = document.getElementById("modalEliminaPrezzoText");
            let text = "Sei sicuro di voler eliminare <b>" + codice + " " + prezzo + "</b> del <b>" + data + "</b>?<br>Una volta eliminato non sarà più possibile recuperarlo.";
            modalBody.innerHTML = text;

            /* Set href modal */
            let button = document.getElementById("modalEliminaPrezzoButton");
            let href = "/business_logic/managerPrestazioni.php?id_prezzo=" + id_prezzo + "&action=eliminaPrezzo";
            button.setAttribute("href", href);

        }

        /* Get listino prezzi array php -> javascript */
        <?php $listinoDic = $prezzoDAO->getListinoDic(); ?>
        const prezzario = <?php echo json_encode($listinoDic) ?>;

        /* Set listino prezzi on set data */
        function setPrezzario(data) {

            /* Get delle righe della tabella dei prezzi */
            let tabellaPrezzi = document.getElementById("tabellaPrezzi");
            let tabellaRows = tabellaPrezzi.getElementsByTagName("tr");

            /* Per ogni riga della tabella dei prezzi (per ogni codice) */
            for (let i = 1; i < tabellaRows.length; i++) {

                /* Get della riga del prezzario telativa al codice i-esimo */
                let cells = tabellaRows[i].getElementsByTagName("td");

                /* Get del codice i-esimo */
                let codice = cells[0].innerHTML;

                /* Get lista di prezzi e date del codice i-esimo */
                let listValueDate = prezzario[codice];
                let data_split = data.split("-"); /* YYYY, MM, DD */
                let inputData = new Date(data_split[0], data_split[1], data_split[2]);
                
                
                /* Get del prezzo in data inputData del codice i-esimo */
                let notAvailable = true; /* Nel caso in cui non vi è il prezzo di quel Prestazione in una data */

                for (let ValueDate of listValueDate) {

                    if (ValueDate[0] == null) continue;

                    let data_split = ValueDate[1].split("-"); /* YYYY, MM, DD */
                    /* Se l'inputData è maggiore della data in cronologia, quello è il prezzo corrente in quella data */
                    if (inputData >= new Date(data_split[0], data_split[1], data_split[2])) {
                        cells[2].innerHTML = ValueDate[0] + "€";
                        notAvailable = false;
                        break;
                    }
                }

                /* Se non sono è stato trovato alcun prezzo per quella data, allora non è disponibile */
                if (notAvailable) {
                    cells[2].innerHTML = "N.A.";
                }

            }

        }


        /* Set colore riga quando si visualizza la cronologia */
        function setRowClicked(rowSelectedStyle) {

            let tabellaPrezziRows = document.getElementById("tabellaPrezzi").getElementsByTagName("tr");
            for (let i = 1; i < tabellaPrezziRows.length; i++) {
                let row = tabellaPrezziRows[i];
                row.style.backgroundColor = "";
            }

            rowSelectedStyle.backgroundColor = "#f1f1f4";
        }


        /* Funzione per la visualizzazione della cronologia */
        function showCrono(codice) {

            let table = document.getElementById("crono_table");
            table.classList.remove("d-none");
            let crono_message = document.getElementById("crono_empty");
            crono_message.style = "display: none !important";


            let rows = table.getElementsByTagName("tr");

            for (i = 1; i < rows.length; i++) {
                if (rows[i].getElementsByTagName("td")[2].innerText == codice) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Including LogoutModal -->
    <?php require __DIR__ . "/../modals/logoutModal.html" ?>

    <?php require __DIR__ . "/../footer.html" ?>

</body>

</html>