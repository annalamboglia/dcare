<?php
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../data_access/dao/AppuntamentoDAO.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Richiesta aggiunta di un appuntamento
    if (isset($_POST["aggiungiAppuntamento"])) {

        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $note = $_POST["note"];
        $datetime = $_POST["datetime"];

        //E.G. 2021-12-05T08:00
        $date = substr($datetime, 0, 10);
        $time_h = substr($datetime, 11, 2);
        $time_m = substr($datetime, 14, 2);

        if (intval($time_m) >= 0 && intval($time_m <= 29)) {
            $time_m = "00";
        }
        else {
            $time_m = "30";
        }

        $datetime = $date . ' ' . $time_h . ':' . $time_m;

        $appuntamentoDAO->insertAppuntamento($nome, $cognome, $note, $datetime);
    }

    /* Modifica Appuntamento */
    else if(isset($_POST["modificaAppuntamento"])) {

        $id_appuntamento = $_GET["id"];
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $note = $_POST["note"];
        $datetime = $_POST["datetime"];

        //E.G. 2021-12-05T08:00
        $date = substr($datetime, 0, 10);
        $time_h = substr($datetime, 11, 2);
        $time_m = substr($datetime, 14, 2);

        if (intval($time_m) >= 0 && intval($time_m <= 29)) {
            $time_m = "00";
        }
        else {
            $time_m = "30";
        }

        $datetime = $date . ' ' . $time_h . ':' . $time_m;

        $appuntamentoDAO->updateAppuntamento($id_appuntamento, $nome, $cognome, $note, $datetime);

    }

}

/* Elimina appuntamento */
else if($_GET["action"] == "eliminaAppuntamento") {

    $id_appuntamento = $_GET["id"];
    $appuntamentoDAO->deleteAppuntamento($id_appuntamento);
}

$data_return = $_GET["data"];
header("Location: /presentation/pages/calendario.php?data=$data_return");

?>
