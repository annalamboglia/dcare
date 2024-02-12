<?php
session_start();
if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true)) {
    header("Location: /presentation/pages/login.php");
    exit;
}

require_once __DIR__ . "/../util/definitions.php";

/* Controllo se l'utente è un dentista */
function checkPermission($role){
    if($role == DENTISTA) return true;
    else return false;
}

?>