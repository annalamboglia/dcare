<?php
require __DIR__ . "/permissionManager.php";
require_once __DIR__ . "/../data_access/dao/ImmagineDAO.php";
require_once __DIR__ . "/../util/definitions.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Caricamento immagine */
    if (isset($_POST["caricaImmagine"])) {

        try {

            $tipo_scheda = $_GET["tipo_scheda"];
            $id_scheda = $_GET["id_scheda"];
            $image = $_FILES["inputImage"];
            $info = pathinfo($image['name']);
            $ext = $info['extension'];      

            /* Riduzione numero di caratteri */
            if (strlen($image['name']) > 50) {
                $image['name'] = substr($image['name'], 0, 50 - strlen($ext) - 1) . ".$ext";
            }

            $pdo->beginTransaction();
            $immagineDAO->insertImage("temp_path", $image["name"], date("Y-m-d"), $tipo_scheda, $id_scheda);
            $last_id = $pdo->lastInsertId();
            $immagineDAO->updatePathImage($last_id, "/immaginiPazienti/img_$last_id.$ext");
            move_uploaded_file($image["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/immaginiPazienti/img_$last_id.$ext");
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo ($e->getMessage());
        }

        // SCHEDA ORTODONTICA
        if ($tipo_scheda == SCHEDA_ORTODONTICA) {
            header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&immagini");
        }

        // SCHEDA ODONTOIATRICA
        else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
            header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&immagini");
        }
    }

    // Modifica nome immagine
    else if (isset($_POST["rinominaImmagine"])) {

        $id_scheda = $_GET["id_scheda"];
        $id_imm = $_GET["id_immagine"];
        $nuovo_nome = $_POST["nomeImmagine"];
        $immagineDAO->updateNameImage($id_imm, $nuovo_nome);

        $tipo_scheda = $_GET["tipo_scheda"];
        // SCHEDA ORTODONTICA
        if ($tipo_scheda == SCHEDA_ORTODONTICA) {
            header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&immagini&id_imm=$id_imm");
        }

        // SCHEDA ODONTOIATRICA
        else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
            header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&immagini&id_imm=$id_imm");
        }
    }
}

// ELIMINAZIONE IMMAGINI
else if ($_GET["action"] == "eliminaImmagine") {

    $id_scheda = $_GET["id_scheda"];
    $id_immagine = $_GET["id_immagine"];

    $imm = $immagineDAO->getImage($id_immagine);

    try {

        // ELIMINAZIONE IMMAGINE DAL DATABASE
        $immagineDAO->deleteImage($id_immagine);

        // ELIMINAZIONE IMMAGINE DAL DISCO
        if(file_exists( __DIR__ . "/.." . $imm["path"])) {
            unlink( __DIR__ . "/.." . $imm["path"]);
        }

    } catch (Exception $e) {
        echo ($e->getMessage());
    }

    $tipo_scheda = $_GET["tipo_scheda"];
    // SCHEDA ORTODONTICA
    if ($tipo_scheda == SCHEDA_ORTODONTICA) {
        header("Location: /presentation/pages/scheda_ortodontica.php?id=$id_scheda&immagini");
    }

    // SCHEDA ODONTOIATRICA
    else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
        header("Location: /presentation/pages/scheda_odontoiatrica.php?id=$id_scheda&immagini");
    }
}

?>