<?php

class Studio
{
    public $nome;
    public $ip;
}

# Lettura degli studi aperti
# DA MODIFICARE IL LINK
$lista_studi = array();
$handle = fopen($_SERVER['DOCUMENT_ROOT'] . "/../util/ipGuests", "r");

if ($handle) {

    while (($line = fgets($handle)) !== false) {
        $studio = new Studio();
        $split = explode('|', $line);
        $studio->nome = $split[0];
        $studio->ip = $split[1];
        array_push($lista_studi, $studio);
    }

    fclose($handle);
} else {
    $lista_studi = [];
}

?>

<div class="modal fade" id="modalApriScheda" role="dialog" aria-labelledby="modalApriScheda" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Invia scheda</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <?php
                    $nome_paziente = $s["nome"];
                    $cognome_paziente = $s["cognome"];
                    $paziente = $nome_paziente . "_" . $cognome_paziente;
                    $paziente = str_replace(' ', '_', $paziente);

                    foreach ($lista_studi as $studio) :
                        $href = "/business_logic/communicationManager.php?action=apriScheda&ip=$studio->ip&tipo_scheda=$tipo_scheda&id=" . $_GET["id"] . "&paziente=$paziente";
                    ?>
                        <a class="btn btn-block btn-outline-primary" href="<?php echo $href; ?>"><?php echo $studio->nome; ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>