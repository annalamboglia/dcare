<?php
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../data_access/dao/SchedaOdontoiatricaDAO.php";
require_once __DIR__ . "/../data_access/dao/SchedaOrtodonticaDAO.php";
require_once __DIR__ . "/../data_access/dao/NotaOdontoiatricaDAO.php";
require_once __DIR__ . "/../data_access/dao/NotaOrtodonticaDAO.php";
require_once __DIR__ . "/../data_access/dao/PagamentoDAO.php";
require_once __DIR__ . "/../util/definitions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Creazione scheda Ortodontica
    if ($_GET["action"] == "createSchedaOrtodontica") {
        $id = $_GET["id"];
        $tipoPrestazione = $_POST["tipoPrestazione"];
        $schedaOrtodonticaDAO->insertSchedaOrtodontica($id, date("Y-m-d"), $tipoPrestazione);
        $id_scheda = $pdo->lastInsertId();
        header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&scheda");
    }

    // Creazione scheda Odontoiatrica
    else if ($_GET["action"] == "createSchedaOdontoiatrica") {
        $id = $_GET["id"];
        $tipoPrestazione = $_POST["tipoPrestazione"];

        $schedaOdontoiatricaDAO->insertSchedaOdontoiatrica($id, date("Y-m-d"), $tipoPrestazione);
        $id_scheda = $pdo->lastInsertId();

        header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&scheda");
    }

    // Modifica tipo prestazione
    else if (isset($_POST["modificaTipoPrestazione"])) {
        $id_scheda = $_GET["id_scheda"];
        $tipo_scheda = $_GET["tipo_scheda"];
        $tipoPrestazione = $_POST["tipoPrestazione"];

        if($tipo_scheda == SCHEDA_ORTODONTICA) {
            $schedaOrtodonticaDAO->updateTipoPrestazione($id_scheda, $tipoPrestazione);
            $return_scheda = "scheda_ortodontica";
        }

        else if($tipo_scheda == SCHEDA_ODONTOIATRICA) {
            $schedaOdontoiatricaDAO->updateTipoPrestazione($id_scheda, $tipoPrestazione);
            $return_scheda = "scheda_odontoiatrica";
        }

        header("Location: /presentation/pages/$return_scheda.php?id=$id_scheda&scheda");
    }

    // Aggiungi trattamento
    else if (isset($_POST["aggiungiNotaOdontoiatrica"])) {

        $id_scheda = $_GET["id_scheda"];
        $ed = $_POST["ed"];
        $trattamento = $_POST["trattamento"];
        $note = $_POST["note"];
        $stato = $_POST["stato"];
        $data = $_POST["data"];

        $notaOdontoiatricaDAO->insertNotaOdontoiatrica($id_scheda, $ed, $trattamento, $note, $stato, $data);
        header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&scheda");
    }

    // Modifica nota
    else if (isset($_POST["modificaNotaOdontoiatrica"])) {

        $id_scheda = $_GET["id_scheda"];
        $id_nota = $_GET["id_nota"];
        $ed = $_POST["ed"];
        $trattamento = $_POST["trattamento"];
        $note = $_POST["note"];
        $stato = $_POST["stato"];
        $data = $_POST["data"];

        $notaOdontoiatricaDAO->updateNotaOdontoiatrica($id_nota, $ed, $trattamento, $note, $stato, $data);
        header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&scheda");
    }

    // INSERIMENTO PRESTAZIONE NEL DIARIO ORTODONTICO
    else if (isset($_POST["aggiungiNotaOrtodontica"])) {
        $prestazioneOdierna = $_POST["inputPrestazioneOdierna"];

        $scheda = $_GET["id_scheda"];
        $notaOrtodonticaDAO->insertNotaOrtodontica($scheda, date("Y-m-d"), $prestazioneOdierna);
        header("Location: /presentation/pages/scheda_ortodontica.php?id=$scheda&scheda");
    }

    // MODIFICA DIARIO ORTODONTICO
    else if (isset($_POST["modificaNotaOrtodontica"])) {
        $id_scheda = $_GET["id_scheda"];
        $id_nota = $_GET["id_nota"];
        $data = $_POST["data"];
        $testo = $_POST["nota"];
        $notaOrtodonticaDAO->updateNotaOrtodontica($id_nota, $data, $testo);
        header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&scheda");
    }

    // INSERIMENTO NOTA E DATA DEL PROSSIMO APPUNTAMENTO 
    else if (isset($_POST["aggiungiProssimoAppuntamento"])) {
        $id_scheda = $_GET["id_scheda"];

        $notaProssimoAppuntamento = $_POST["notaProssimoAppuntamento"];
        $daRivedereTra = $_POST["daRivedereTra"];
        $unitaTempo = $_POST["unitaTempo"];

        if ($daRivedereTra == "") {
            $dataProssimoAppuntamento = "";
            $schedaOrtodonticaDAO->updateProssimoAppuntamento($id_scheda, $notaProssimoAppuntamento, "");
        } else if ($unitaTempo == "Giorni") {
            $dataProssimoAppuntamento = strtotime(date("Y-m-d") . "+ $daRivedereTra days");
            $schedaOrtodonticaDAO->updateProssimoAppuntamento($id_scheda, $notaProssimoAppuntamento, date("Y-m-d", $dataProssimoAppuntamento));
        } else if ($unitaTempo == "Mesi") {
            $dataProssimoAppuntamento = strtotime(date("Y-m-d") . "+ $daRivedereTra months");
            $schedaOrtodonticaDAO->updateProssimoAppuntamento($id_scheda, $notaProssimoAppuntamento, date("Y-m-d", $dataProssimoAppuntamento));
        }

        header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&scheda");
    }
}

// RIMOZIONE TRATTAMENTO
else if ($_GET["action"] == "deleteNotaOdontoiatrica") {

    $notaOdontoiatricaDAO->deleteNotaOdontoiatrica($_GET["id_nota"]);
    $id_scheda = $_GET["id_scheda"];
    header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&scheda");
}

// RIMOZIONE SCHEDA ODONTOIATRICA. PARAMETRI: ID_SCHEDA, ID_PAZIENTE
else if ($_GET["action"] == "deleteSchedaOdontoiatrica") {

    $schedaOdontoiatricaDAO->deleteSchedaOdontoiatrica($_GET["id_scheda"]);
    $id_paziente = $_GET["id_paziente"];
    header("Location: /presentation/pages/cartella_clinica.php?id=$id_paziente&scheda");
}

// RIMOZIONE SCHEDA ORTODONTICA. PARAMETRI: ID_SCHEDA, ID_PAZIENTE
else if ($_GET["action"] == "deleteSchedaOrtodontica") {
    $schedaOrtodonticaDAO->deleteSchedaOrtodontica($_GET["id_scheda"]);
    $id_paziente = $_GET["id_paziente"];
    header("Location: /presentation/pages/cartella_clinica.php?id=$id_paziente&scheda");

    // Eliminazione Diario
} else if ($_GET["action"] == "deleteNotaOrtodontica") {
    $id_nota = $_GET["id_nota"];
    $id_scheda = $_GET["id_scheda"];
    $notaOrtodonticaDAO->deleteNotaOrtodontica($id_nota);
    header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&scheda");
}
