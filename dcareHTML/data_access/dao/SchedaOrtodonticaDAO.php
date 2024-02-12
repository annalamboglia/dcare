<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class SchedaOrtodonticaDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertSchedaOrtodontica($paziente, $dataApertura, $tipoPrestazione)
    {

        try {

            $sql = "INSERT INTO SCHEDEORTODONTICHE(paziente, dataApertura, tipoPrestazione, chiuso) VALUES(:paziente, :dataApertura, :tipoPrestazione, 0)";
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
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getSchedeOrtodontiche($paziente)
    {
        try {
            $sql = "SELECT * FROM SCHEDEORTODONTICHE WHERE PAZIENTE = :paziente ORDER BY dataApertura DESC";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":paziente", $paziente);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function deleteSchedaOrtodontica($id)
    {
        try {
            $sql = "DELETE FROM SCHEDEORTODONTICHE WHERE id = :id";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":id", $id);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    // OTTIENI SCHEDA E PAZIENTE ASSOCIATO
    public function getInfoSchedaOrtodontica($id)
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
            sc.preventivo,
            sc.notaProssimoAppuntamento,
            sc.dataProssimoAppuntamento
            FROM PAZIENTI PA RIGHT JOIN schedeortodontiche SC ON SC.paziente = pa.id WHERE SC.ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Modifica data ultimo accesso */
    public function saveAccess($id, $date)
    {
        try {
            $sql = "UPDATE SCHEDEORTODONTICHE SET DATAULTIMOACCESSO = :date WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":date", $date);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Modifica il tipo di prestazione */
    public function updateTipoPrestazione($id, $tipoPrestazione)
    {
        try {
            $sql = "UPDATE SCHEDEORTODONTICHE SET TIPOPRESTAZIONE = :tipoPrestazione WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":tipoPrestazione", $tipoPrestazione);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Modifica data e nota del prossimo appuntamento */
    public function updateProssimoAppuntamento($id, $notaProssimoAppuntamento, $dataProssimoAppuntamento)
    {
        try {
            $sql = "UPDATE SCHEDEORTODONTICHE SET notaProssimoAppuntamento = :notaProssimoAppuntamento, dataProssimoAppuntamento = :dataProssimoAppuntamento WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":notaProssimoAppuntamento", $notaProssimoAppuntamento);

            if ($dataProssimoAppuntamento != "") {
                $stm->bindparam(":dataProssimoAppuntamento", $dataProssimoAppuntamento);
            } else {
                $null = "NULL";
                $stm->bindparam(":dataProssimoAppuntamento", $null, PDO::PARAM_NULL);
            }

            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    /* Modifica preventivo */
    public function updatePreventivo($id, $preventivo)
    {
        try {
            $sql = "UPDATE SCHEDEORTODONTICHE SET preventivo = :preventivo WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->bindparam(":preventivo", $preventivo);

            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }
}
/* Oggetto DAO */
global $pdo;
$schedaOrtodonticaDAO = new SchedaOrtodonticaDAO($pdo);
?>
