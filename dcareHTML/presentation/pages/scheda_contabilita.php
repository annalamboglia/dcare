<!-- Cards sulla contabilità -->
<!-- DEFINIRE VARIABILI tipo_scheda PRIMA DELL'INCLUSIONE E s -->
<?php
require_once __DIR__ . "/../../data_access/dao/PagamentoDAO.php";

/* Calcolo e get dei pagamenti effettuati, dell'pagamento e del saldo rimanente */
$pagamenti = $pagamentoDAO->getPagamentiScheda($_GET["id"], $tipo_scheda);
$pagamento = $pagamentoDAO->getTotalePagamenti($_GET["id"], $tipo_scheda);
$saldo = (float)($s["preventivo"] - $pagamento);

/* Calcolo del preventivo */
if (isset($_GET["data"])) {
    $data = $_GET["data"];
}


?>


<div class="card-deck">

    <!-- Carta preventivo -->
    <div class="card border-left-primary shadow h-100 p-2" data-toggle="modal" , data-target="#modalModificaPreventivo">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col">
                    <div class="h4 text-primary">Preventivo</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">€<?php echo ($s['preventivo']); ?></div>
                </div>
                <div class="col-auto">
                    <span class="fas fa-comment-dollar fa-2x text-gray-300"></span>
                </div>

            </div>

        </div>

    </div>
    <!-- End carta preventivo -->

    <!-- Carta pagamento -->
    <div class="card border-left-success shadow h-100 p-2">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col">
                    <div class="h4 text-primary">Pagamento</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">€<?php echo ($pagamento) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-balance-scale fa-2x text-gray-300"></i>
                </div>

            </div>

        </div>

    </div>
    <!-- End carta pagamento -->

    <!-- Carta saldo -->
    <div class="card border-left-danger shadow h-100 p-2">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col">
                    <div class="h4 text-primary">Saldo</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">€<?php echo number_format($saldo, $decimals = 2) ?></div>
                </div>

                <!-- Barra del saldo -->
                <div class="col">
                    <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" style="width: <?php if ($s["preventivo"] == 0) echo ('0');
                                                                        else echo ((1 - $saldo / $s["preventivo"]) * 100); ?>%"></div>
                    </div>
                </div>

                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>

            </div>

        </div>

    </div>
    <!-- End carta saldo -->


</div>
<!-- End cards sulla contabilità -->


<!-- Blocco di ricevuta e registra pagamento -->
<div class="row mt-5">

    <!-- Tabella pagamenti -->
    <div class="col-8 bg-white border px-0" style="max-height: 40vh; min-height: 40vh; overflow: auto;">
        <table class="table table-bordered">
            <thead class="bg-primary text-white" style="position: sticky; top: 0;">
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">#Pagamento</th>
                    <th scope="col">Importo</th>
                    <th scope="col">Nota</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($pagamenti as $p) { ?>
                    <tr id="<?php echo ($p["id"]); ?>" class="row-hover" data-toggle="modal" data-target="#modalModificaPagamento" onclick="setModalModificaPagamento(this, <?php echo ($_GET['id']); ?>, <?php echo ($tipo_scheda) ?>)">
                        <td><?php echo date("d-m-Y", strtotime($p["data"])) ?></td>
                        <td><?php echo ($p["id"]) ?></td>
                        <td><?php echo ($p["importo"] . '€') ?></td>
                        <td><?php echo ($p["nota"]) ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <!-- End Tabella acconti -->


    <!-- Registra pagamento -->
    <div class="col-4">

        <form action="/business_logic/contabilita.php?id_scheda=<?php echo ($_GET["id"]); ?>&tipo_scheda=<?php echo ($tipo_scheda); ?>" method="POST" style="height: 100%;">

            <div class="form-group">
                <label style="white-space: nowrap;">Data pagamento</label>
                <input type="date" class="form-control" name="dataPagamento" value="<?php echo (date("Y-m-d")); ?>">
            </div>

            <div class="form-group">
                <label>Importo</label>
                <input type="number" class="form-control" min="0" max="999999.99" step=".01" name="importoPagamento" required>
            </div>

            <div class="form-group">
                <label>Nota</label>
                <input type="text" class="form-control" name="notaPagamento" maxlength="100">
            </div>

            <button class="btn btn-primary" type="submit" class="btn btn-primary" name="aggiungiPagamento">Aggiungi pagamento</button>

        </form>
    </div>
    <!-- End registra pagamento -->

</div>
<!-- End blocco di ricevuta e registra pagamento -->

<!-- Modal modifica preventivo -->
<div class="modal fade" id="modalModificaPreventivo" role="dialog" aria-labelledby="modalModificaPreventivo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Modifica preventivo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/business_logic/contabilita.php?id_scheda=<?php echo ($_GET['id']); ?>&tipo_scheda=<?php echo ($tipo_scheda); ?>" method="POST">

                <div class="modal-body">
                    <label class="form-label text-gray-900">Preventivo</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                        </div>
                        <input type="number" class="form-control" name="preventivo" min="0" max="999999.99" step=".01" value="<?php echo ($s['preventivo']); ?>">
                    </div>

                    <?php if ($tipo_scheda == SCHEDA_ODONTOIATRICA) { ?>
                        <div class="d-none form-inline">
                            <a class="btn btn-secondary mr-4" href="./scheda_odontoiatrica.php?id=<?php echo ($_GET['id']); ?>&data=:data&contabilita" onclick="setCalcolaHref(this, 'data_calcola')">Calcola</a>
                            <input id="data_calcola" type="date" class="form-control" value="<?php echo date("Y-m-d"); ?>"></input>
                        </div>
                    <?php } ?>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" name="modificaPreventivo">Modifica</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal modifica pagamaneto -->
<div class="modal fade" id="modalModificaPagamento" role="dialog" aria-labelledby="modalModificaPagamento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Modifica pagamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalModificaPagamentoForm" action="" method="POST">

                <div class="modal-body">

                    <div class="modal-body">
                        <label class="form-label text-gray-900">Data Pagamento</label>
                        <input type="date" class="form-control" id="modalDataPagamento" name="dataPagamento" value="">
                    </div>

                    <div class="modal-body">
                        <label class="form-label text-gray-900">Importo</label>
                        <input type="number" class="form-control" min="0" max="999999.99" step=".01" id="modalImportoPagamento" name="importoPagamento" required>
                    </div>

                    <div class="modal-body">
                        <label class="form-label text-gray-900">Nota</label>
                        <input type="text" class="form-control" id="modalNotaPagamento" name="notaPagamento" maxlength="100">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal" data-toggle="modal" data-target="#modalEliminaPagamento" onclick="removeFadeModalModificaPagamento()">Elimina</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" name="modificaPagamento">Modifica</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal elimina pagamento -->
<div class="modal" id="modalEliminaPagamento" role="dialog" aria-labelledby="modalEliminaPagamento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Elimina Pagamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modalEliminaPagamentoBody" class="modal-body"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <a id="modalEliminaPagamentoButton" href="/business_logic/contabilita.php?id_scheda=:id_scheda&id_pagamento=:id_pagamento&tipo_scheda=:tipo_scheda&action=eliminaPagamento" class="btn btn-danger" name="eliminaPagamento">Elimina</a>
            </div>
        </div>
    </div>
</div>