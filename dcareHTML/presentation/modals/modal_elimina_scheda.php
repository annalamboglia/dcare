<!--
      
    Modal conferma eliminazione scheda 

    Require:
    $s: informazioni della scheda
        
        -----
        Campi
        -----
        id_paziente
    
    $_GET
        
        -----
        Campi
        -----
        id: id della scheda

    $tipo_scheda
        $tipo_scheda = 0 -> scheda ortodontica
        $tipo_scheda = 1 -> scheda odontoiatrica

-->
<?php
    require_once __DIR__ . "/../../util/definitions.php";

    $href_scheda_ortodontica = '/business_logic/managerScheda.php?id_paziente=' . $s["id_paziente"] . '&id_scheda=' . $_GET["id"] . '&action=deleteSchedaOrtodontica';
    $href_scheda_odontoiatrica = '/business_logic/managerScheda.php?id_paziente=' . $s["id_paziente"] . '&id_scheda=' . $_GET["id"] . '&action=deleteSchedaOdontoiatrica';

?>
<div class="modal fade" id="modalEliminaScheda" role="dialog" aria-labelledby="modalEliminaScheda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Elimina scheda</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare la scheda? Una volta eliminata non sarà più possibile recuperarla.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <a type="button" class="btn btn-danger" href="<?php if($tipo_scheda == SCHEDA_ORTODONTICA) echo($href_scheda_ortodontica); else if($tipo_scheda == SCHEDA_ODONTOIATRICA) echo($href_scheda_odontoiatrica); ?>">Elimina</a>
            </div>
        </div>
    </div>
</div>