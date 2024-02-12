<?php
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../util/definitions.php";
require_once __DIR__ . "/../data_access/dao/PagamentoDAO.php";
require_once __DIR__ . "/../data_access/dao/SchedaOrtodonticaDAO.php";
require_once __DIR__ . "/../data_access/dao/SchedaOdontoiatricaDAO.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inserimento pagamento
    if (isset($_POST["aggiungiPagamento"])) {
        $tipo_scheda = $_GET["tipo_scheda"];
        $id_scheda = $_GET["id_scheda"];
        $dataPagamento = $_POST["dataPagamento"];
        $importoPagamento = $_POST["importoPagamento"];
        $notaPagamento = $_POST["notaPagamento"];
        $pagamentoDAO->insertPagamento($dataPagamento, $importoPagamento, $notaPagamento, $id_scheda, $tipo_scheda);
    }

    // MODIFICA ACCONTO
    else if (isset($_POST["modificaPagamento"])) {
        $id_scheda = $_GET["id_scheda"];
        $id_pagamento = $_GET["id_pagamento"];

        $dataPagamento = $_POST["dataPagamento"];
        $importoPagamento = $_POST["importoPagamento"];
        $notaPagamento = $_POST["notaPagamento"];

        $pagamentoDAO->updatePagamento($id_pagamento, $dataPagamento, $importoPagamento, $notaPagamento);

    }

    // MODIFICA PREVENTIVO
    else if (isset($_POST["modificaPreventivo"])) {
        $id_scheda = $_GET["id_scheda"];
        $tipo_scheda = $_GET["tipo_scheda"];
        $preventivo = $_POST["preventivo"];

        if ($tipo_scheda == SCHEDA_ORTODONTICA) {
            $schedaOrtodonticaDAO->updatePreventivo($id_scheda, $preventivo);
        } 
        
        else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
            $schedaOdontoiatricaDAO->updatePreventivo($id_scheda, $preventivo);
        }
    }
} 

else if ($_GET["action"] == "eliminaPagamento") {
    $id_scheda = $_GET["id_scheda"];
    $id_pagamento = $_GET["id_pagamento"];

    $pagamentoDAO->deletePagamento($id_pagamento);
}

$tipo_scheda = $_GET["tipo_scheda"];

// SCHEDA ORTODONTICA
if ($tipo_scheda == SCHEDA_ORTODONTICA) {
    header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&contabilita");
}

// SCEDA ODONTOIATRICA
else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
    header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&contabilita");
}

?>
