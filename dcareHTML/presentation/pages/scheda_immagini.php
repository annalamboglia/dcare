<!-- Definire variabile php tipo_scheda -->
<!-- Fluid container -->

<?php
// SCHEDA VARIABILE PER HREF DELLA LISTA IMMAGINI
if ($tipo_scheda == 0) {
    $scheda = "scheda_ortodontica";
} else if ($tipo_scheda == 1) {
    $scheda = "scheda_odontoiatrica";
}

// OTTENIMENTO IMMAGINI
require_once __DIR__ . "/../../data_access/dao/ImmagineDAO.php";
$immagini = $immagineDAO->getImages($_GET["id"], $tipo_scheda);

// Booleana per il check se è stata caricata almane un'immagine
$imm_caricate = count($immagini) > 0 ? True : False;

// Immagine selezionata tramite get
if (isset($_GET["id_imm"])) {
    foreach ($immagini as $imm) {
        if ($imm["id"] == $_GET["id_imm"]) {
            $imm_selected_path =  $imm["path"];
            $imm_selected = $imm;
            break;
        }
    }
}

// Se non è selezionata alcuna immagine in get, viene selezionata la prima
else if ($imm_caricate) {
    $imm_selected_path = $immagini[0]["path"];
    $_GET["id_imm"] = $immagini[0]["id"];
    $imm_selected = $immagini[0];
}
?>

<div class="container-fluid">

    <!-- Image row -->
    <div class="row">

        <!-- Image column -->
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <?php if ($imm_caricate  && file_exists($_SERVER["DOCUMENT_ROOT"] . $imm_selected_path)) : ?>
                        <img class="img-fluid" src="<?php if (count($immagini) > 0) echo ($imm_selected_path); ?>">
                    <?php else : ?>
                        <div class="row justify-content-center mt-2">
                            <div class="fas fa-file-image fa-9x"></div>
                        </div>
                        <div class="row justify-content-center mt-2">
                            <?php if ($imm_caricate) : ?>
                                <h5>Immagine non trovata</h5>
                            <?php else : ?>
                                <h5>Carica un'immagine</h5>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <!-- EMD Image column -->

        <!-- Path column -->
        <div class="col-12 col-lg-3">

            <!-- Card path column -->
            <div class="card">

                <!-- Card path header -->
                <div class="card-header pb-0 bg-primary text-white">
                    <div class="row">
                        <div class="col-auto">
                            <h4>Immagini</h4>
                        </div>
                        <div class="ml-auto">
                            <div class="fas fa-folder fa-lg text-white"></div>
                        </div>
                    </div>
                </div>
                <!-- END card path header -->

                <!-- Card body -->
                <div class="card-body px-0 py-0">
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 30rem;">
                        <?php foreach ($immagini as $imm) { ?>

                            <a class="text-decoration-none" href="<?php echo ("$scheda.php?id=" . $_GET["id"] . "&immagini&id_imm=" . $imm["id"]); ?>">
                                <li class="list-group-item <?php if (isset($_GET["id_imm"]) && $_GET["id_imm"] == $imm["id"]) echo ("bg-primary text-white");
                                                            else echo ("cu-focus"); ?>"><?php echo ($imm["nome"]); ?></li>
                            </a>

                        <?php } ?>

                    </ul>
                </div>
                <!-- END carb body -->

                <!-- Card footer -->
                <div class="card-footer">
                    <form action="/business_logic/managerFile.php?id_scheda=<?php echo ($_GET['id']); ?>&tipo_scheda=<?php echo ($tipo_scheda); ?>" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="inputImage" id="inputImage" accept="image/*" required>
                                <label id="imageText" class="custom-file-label overflow-hidden" for="inputImage">Carica un'immagine</label>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="caricaImmagine">Carica</button>
                        </div>
                    </form>
                </div>
                <!-- END Card footer -->

            </div>
            <!-- END Card path column -->

            <!-- Immage buttons -->
            <?php if (count($immagini) > 0) { ?>
                <div class="d-flex flex-md-row-reverse mt-2">
                    <button type="button" class="btn btn-danger ml-2" name="eliminaImmagine" data-toggle="modal" data-target="#modalEliminaImmagine">Elimina</button>
                    <button type="button" class="btn btn-primary" name="rinominaImmagine" data-toggle="modal" data-target="#modalRinominaImmagine">Rinomina</button>
                </div>
            <?php } ?>

        </div>
        <!-- END Path column -->
    </div>
    <!-- END image row -->
</div>
<!-- END Fluid container -->

<!-- Modal rinomina immagine -->
<div class="modal fade" id="modalRinominaImmagine" role="dialog" aria-labelledby="modalRinominaImmagine" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Rinomina immagine</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/business_logic/managerFile.php?id_scheda=<?php echo ($_GET['id']); ?>&id_immagine=<?php echo ($imm_selected["id"]); ?>&tipo_scheda=<?php echo ($tipo_scheda); ?>" method="POST">
                <div class="modal-body">
                    <label class="form-label text-gray-900">Nome immagine</label>
                    <input type="text" class="form-control" maxlength="50" name="nomeImmagine" value="<?php echo ($imm_selected["nome"]); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" name="rinominaImmagine">Modifica</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal elimina immagine -->
<div class="modal fade" id="modalEliminaImmagine" role="dialog" aria-labelledby="modalEliminaImmagine" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Elimina immagine</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare l'immagine <b><?php echo ($imm_selected['nome']); ?></b>?<br>Una volta eliminata non sarà più possibile recuperarla.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <a type="button" class="btn btn-danger" href="/business_logic/managerFile.php?id_scheda=<?php echo ($_GET['id']); ?>&id_immagine=<?php echo ($imm_selected["id"]); ?>&action=eliminaImmagine&tipo_scheda=<?php echo ($tipo_scheda); ?>">Elimina</a>
            </div>
        </div>
    </div>
</div>