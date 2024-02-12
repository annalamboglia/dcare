<!--
      
    Modal modifica tipo prestazione scheda 

    Require:
    $s: informazioni della scheda
        
        -----
        Campi
        -----
        tipoPrestazione
    
    $_GET
        
        -----
        Campi
        -----
        id: id della scheda

    $tipo_scheda
        $tipo_scheda = 0 -> scheda ortodontica
        $tipo_scheda = 1 -> scheda odontoiatrica

-->

<div class="modal fade" id="modalModificaTipoPrestazione" role="dialog" aria-labelledby="modalModificaTipoPrestazione" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Modifica tipo prestazione</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/business_logic/managerScheda.php?id_scheda=<?php echo ($_GET['id']); ?>&tipo_scheda=<?php echo $tipo_scheda ?>" method="POST">
                <div class="modal-body">
                    <input type="text" class="form-control" maxlength="50" name="tipoPrestazione" value="<?php echo ($s['tipoPrestazione']); ?>" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary" name="modificaTipoPrestazione">Modifica</button>
                </div>
            </form>
        </div>
    </div>
</div>
