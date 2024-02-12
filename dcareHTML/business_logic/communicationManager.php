<?php 
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../util/definitions.php";

if($_GET["action"] == "apriScheda") {

    $ip = $_GET["ip"];
    $tipo_scheda = $_GET["tipo_scheda"] == SCHEDA_ORTODONTICA ? "scheda_ortodontica" : "scheda_odontoiatrica";
    $id_scheda = $_GET["id"];
    $paziente = str_replace('_', ' ', $_GET["paziente"]);

    $port = 5007;
    $input = $id_scheda . '|' . $tipo_scheda . '|' . $paziente;

    # Creazione socket
    $sock = socket_create(AF_INET, SOCK_DGRAM, 0);
    socket_sendto($sock, $input , strlen($input) , 0 , $ip , $port);

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>