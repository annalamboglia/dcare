<?php
require_once __DIR__ . "/../connection_manager/connection.php";
require_once __DIR__ . "/../../util/definitions.php";

class PagamentoDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    // TIPO SCHEDA: 0 ORTODONTICA, 1 ODONTOIATRICA
    function insertPagamento($data, $importo, $nota, $id_scheda, $tipo_scheda)
    {

        try {
            if ($tipo_scheda == 0) {
                $sql = "INSERT INTO PAGAMENTI (data, importo, nota, schedaOrtodontica) VALUES (:data, :importo, :nota, :id_scheda)";
            } else if ($tipo_scheda == 1) {
                $sql = "INSERT INTO PAGAMENTI (data, importo, nota, schedaOdontoiatrica) VALUES (:data, :importo, :nota, :id_scheda)";
            }

            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":data", $data);
            $stm->bindparam(":importo", $importo);
            $stm->bindparam(":nota", $nota);
            $stm->bindparam(":id_scheda", $id_scheda);

            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    // TIPO SCHEDA: 0 ORTODONTICA, 1 ODONTOIATRICA
    function getPagamentiScheda($id_scheda, $tipo_scheda)
    {
        try {
            if ($tipo_scheda == SCHEDA_ORTODONTICA) {
                $sql = "SELECT * FROM PAGAMENTI WHERE schedaOrtodontica = :id_scheda ORDER BY DATA DESC";
            } else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
                $sql = "SELECT * FROM PAGAMENTI WHERE schedaOdontoiatrica = :id_scheda ORDER BY DATA DESC";
            }

            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id_scheda", $id_scheda);

            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function getTotalePagamenti($id_scheda, $tipo_scheda)
    {
        try {
            if ($tipo_scheda == 0) {
                $sql = "SELECT SUM(importo) AS totale FROM PAGAMENTI WHERE schedaOrtodontica = :id_scheda";
            } else if ($tipo_scheda == 1) {
                $sql = "SELECT SUM(importo) AS totale FROM PAGAMENTI WHERE schedaOdontoiatrica = :id_scheda";
            }

            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id_scheda", $id_scheda);

            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC)["totale"];
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function updatePagamento($id, $data, $importo, $nota)
    {
        try {

            $sql = "UPDATE PAGAMENTI SET data = :data, importo = :importo, nota = :nota WHERE id = :id";

            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":data", $data);
            $stm->bindparam(":importo", $importo);
            $stm->bindparam(":nota", $nota);
            $stm->bindparam(":id", $id);

            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function deletePagamento($id) {
        try {

            $sql = "DELETE FROM PAGAMENTI WHERE id = :id";
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
$pagamentoDAO = new PagamentoDAO($pdo);
?>
