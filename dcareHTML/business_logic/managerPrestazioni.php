<?php
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../data_access/dao/PrestazioneDAO.php";
require_once __DIR__ . "/../data_access/dao/PrezzoDAO.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Aggiungi Prestazione
    if (isset($_POST["aggiungiPrestazione"])) {
        $codice = strtoupper($_POST["codice"]);
        $nome = $_POST["nome"];
        $prestazioneDAO->insertPrestazione($codice, $nome);
    }

    // Modifica Prestazione
    else if (isset($_POST["modificaPrestazione"])) {
        $id = $_GET["id_prestazione"];
        $codice = strtoupper($_POST["codice"]);
        $nome = $_POST["nome"];
        $prestazioneDAO->updatePrestazione($id, $codice, $nome);
    }

    // Aggiungi prezzo
    else if (isset($_POST["aggiungiPrezzo"])) {

        $prestazione = $_POST["prestazione"];
        $prezzo = $_POST["prezzo"];
        $data = $_POST["data"];
        $prezzoDAO->insertPrezzo($prestazione, $prezzo, $data);
    }

    // Modifica prezzo
    else if (isset($_POST["modificaPrezzo"])) {

        $id = $_GET["id_prezzo"];
        $prezzo = $_POST["prezzo"];
        $data = $_POST["data"];
        $prezzoDAO->updatePrezzo($id, NULL, $prezzo, $data);
    }
}

// Elimina Prestazione
else if ($_GET["action"] == "eliminaPrestazione") {
    $id_prestazione = $_GET["id_prestazione"];
    $prestazioneDAO->deletePrestazione($id_prestazione);
}

// Elimina prezzo
else if ($_GET["action"] == "eliminaPrezzo") {
    $id_prezzo = $_GET["id_prezzo"];
    $prezzoDAO->deletePrezzo($id_prezzo);
}

header("Location: /presentation/pages/prestazioni.php");
?>