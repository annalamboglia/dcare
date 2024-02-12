<?php
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../data_access/dao/PazienteDAO.php";
require_once __DIR__ . "/../data_access/dao/PaganteDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Richiesta aggiunta di un paziente
    if (isset($_POST["aggiungiPaziente"])) {

        // DATI PAZIENTE
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $dataNascita = $_POST["dataNascita"];
        $residenza = $_POST["residenza"];
        $provincia = $_POST["provincia"];
        $cap = $_POST["cap"];
        $telefono = $_POST["telefono"];
        $cellulare = $_POST["cellulare"];
        $email = $_POST["email"];

        // DATI PAGENTE
        $pnome = $_POST["pnome"];
        $pcognome = $_POST["pcognome"];
        $psesso = $_POST["psesso"];
        $pcittaNascita = $_POST["pcittaNascita"];
        $pdataNascita = $_POST["pdataNascita"];
        $pprovinciaNascita = $_POST["pprovinciaNascita"];
        $presidenza = $_POST["presidenza"];
        $pprovincia = $_POST["pprovincia"];
        $pcap = $_POST["pcap"];
        $pprestazioni = $_POST["pprestazioni"];
        $pcf = $_POST["pcf"];


        //SCRITTURA NEL DATABASE
        $pazienteDAO->insertPaziente($nome, $cognome, $dataNascita, $residenza, $provincia, $cap, $telefono, $cellulare, $email);
        $paziente = $pdo->lastInsertId();
        $paganteDAO->insertPagante($pnome, $pcognome, $psesso, $pcittaNascita, $pdataNascita, $pprovinciaNascita, $presidenza, $pprovincia, $pcap, $pprestazioni, $pcf, $paziente);

        header("Location: /presentation/pages/cartella_clinica.php?id=$paziente");
    }

    // Richiesta modifica dati anagrafici
    else if (isset($_POST["modificaPaziente"])) {

        // DATI PAZIENTE
        $id = $_GET["id_paziente"];
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $dataNascita = $_POST["dataNascita"];
        $residenza = $_POST["residenza"];
        $provincia = $_POST["provincia"];
        $cap = $_POST["cap"];
        $telefono = $_POST["telefono"];
        $cellulare = $_POST["cellulare"];
        $email = $_POST["email"];

        // DATI PAGENTE
        $idPagante = $_GET["id_pagante"];
        $pnome = $_POST["pnome"];
        $pcognome = $_POST["pcognome"];
        $psesso = $_POST["psesso"];
        $pcittaNascita = $_POST["pcittaNascita"];
        $pdataNascita = $_POST["pdataNascita"];
        $pprovinciaNascita = $_POST["pprovinciaNascita"];
        $presidenza = $_POST["presidenza"];
        $pprovincia = $_POST["pprovincia"];
        $pcap = $_POST["pcap"];
        $pprestazioni = $_POST["pprestazioni"];
        $pcf = $_POST["pcf"];


        // Scrittura nel database
        // da aggiungere id e pagante
        $pazienteDAO->updatePaziente($id, $nome, $cognome, $dataNascita, $residenza, $provincia, $cap, $telefono, $cellulare, $email);
        $paganteDAO->updatePagante($idPagante, $pnome, $pcognome, $psesso, $pcittaNascita, $pdataNascita, $pprovinciaNascita, $presidenza, $pprovincia, $pcap, $pprestazioni, $pcf);

        header("Location: /presentation/pages/cartella_clinica.php?id=$id");
    }

} else if (isset($_GET["action"])) {

    // Funzione cestinaggio paziente
    if ($_GET["action"] == "cestinaPaziente") {

        $id = $_GET["id"];
        $pazienteDAO->moveCestino($id);
        header("Location: /presentation/pages/lista_pazienti.php");
    }

    // Funzione eliminazione paziente
    else if ($_GET["action"] == "eliminaPaziente") {

        $id = $_GET["id"];
        $pazienteDAO->deletePaziente($id);
        header("Location: /presentation/pages/lista_pazienti.php?cestino");

    } else if ($_GET["action"] == "ripristinaPaziente") {

        $id = $_GET["id"];
        $pazienteDAO->ripristinaPaziente($id);
        header("Location: /presentation/pages/cartella_clinica.php?id=$id");
    
    } else if ($_GET["action"] == "svuotaCestino") {

        $pazienteDAO->deleteCestino();
        header("Location:  /presentation/pages/lista_pazienti.php?cestino");
    }
}

?>