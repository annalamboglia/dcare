<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class SchedaOdontoiatricaDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }


    function insertSchedaOdontoiatrica($paziente, $dataApertura, $tipoPrestazione)
    {

        $sql = "INSERT INTO SCHEDEODONTOIATRICHE(paziente, dataApertura, tipoPrestazione, chiuso) VALUES(:paziente, :dataApertura, :tipoPrestazione, 0)";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":paziente", $paziente);
        $stm->bindparam(":tipoPrestazione", $tipoPrestazione);

        if ($dataApertura != "") {
            $stm->bindparam(":dataApertura", $dataApertura);
        } else {
            $null = "NULL";
            $stm->bindparam(":dataApertura", $null, PDO::PARAM_NULL);
        }

        $stm->execute();
    }

    public function getSchedeOdontoiatriche($paziente)
    {
        try {
            $sql = "SELECT * FROM SCHEDEODONTOIATRICHE WHERE PAZIENTE = :paziente ORDER BY dataApertura DESC";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":paziente", $paziente);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getInfoSchedaOdontoiatrica($id)
    {
        try {
            $sql = "SELECT
            pa.id as id_paziente,
            pa.nome as nome,
            pa.cognome,
            pa.dataNascita,
            pa.residenza,
            pa.provincia,
            pa.cap,
            pa.telefono,
            pa.email,
            pa.cestino,
            sc.id as id_scheda,
            sc.dataApertura,
            sc.dataUltimoAccesso,
            sc.tipoPrestazione,
            sc.preventivo
            FROM PAZIENTI PA RIGHT JOIN SCHEDEODONTOIATRICHE SC ON SC.paziente = pa.id WHERE SC.ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Modifica il tipo di prestazione */
    public function updateTipoPrestazione($id, $tipoPrestazione)
    {
        try {
            $sql = "UPDATE SCHEDEODONTOIATRiCHE SET TIPOPRESTAZIONE = :tipoPrestazione WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":tipoPrestazione", $tipoPrestazione);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Modifica Preventivo */
    public function updatePreventivo($id, $preventivo) {
        try {
            $sql = "UPDATE SCHEDEODONTOIATRICHE SET PREVENTIVO = :preventivo WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":preventivo", $preventivo);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    /* Modifica data ultimo accesso */
    public function saveAccess($id, $date)
    {
        try {
            $sql = "UPDATE SCHEDEODONTOIATRICHE SET DATAULTIMOACCESSO = :date WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":date", $date);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    /* Eliminazione scheda odontoiatrica */
    public function deleteSchedaOdontoiatrica($id)
    {
        try {
            $sql = "DELETE FROM SCHEDEODONTOIATRICHE WHERE id = :id";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":id", $id);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }
}

/* Oggetto DAO */
global $pdo;
$schedaOdontoiatricaDAO = new SchedaOdontoiatricaDAO($pdo);
?>