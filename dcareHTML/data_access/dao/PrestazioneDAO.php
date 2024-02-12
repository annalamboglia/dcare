<?php
require_once __DIR__ . "/../connection_manager/connection.php";
require_once __DIR__ . "/../../util/definitions.php";

class PrestazioneDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getPrestazioni()
    {
        try {
            $sql = "SELECT * FROM PRESTAZIONI ORDER BY CODICE";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Per sviluppi futuri, quando ha senso dividere le prestazioni
     * per reparto */
    /*
    function getPrestazioniByReparto($reparto)
    {

        switch ($reparto) {
            case SCHEDA_ORTODONTICA:
                $sql = "SELECT * FROM PRESTAZIONI WHERE ortodonzia = 1";
                break;

            case SCHEDA_ODONTOIATRICA:
                $sql = "SELECT * FROM PRESTAZIONI WHERE odontoiatria = 1";
        }


        try {
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }
    */


    function insertPrestazione($codice, $nome)
    {
        try {
            $sql = "INSERT INTO PRESTAZIONI(codice, nome) VALUES(:codice, :nome)";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":codice", $codice);
            $stm->bindparam(":nome", $nome);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function deletePrestazione($id)
    {
        try {
            $sql = "DELETE FROM PRESTAZIONI WHERE id = :id";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":id", $id);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function updatePrestazione($id, $codice, $nome)
    {
        try {
            $sql = "UPDATE PRESTAZIONI SET codice = :codice, nome = :nome WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":codice", $codice);
            $stm->bindparam(":nome", $nome);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }
}

/* Oggetto DAO */
global $pdo;
$prestazioneDAO = new PrestazioneDAO($pdo);
