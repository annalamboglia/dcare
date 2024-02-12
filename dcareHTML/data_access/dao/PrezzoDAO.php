<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class PrezzoDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getPrezzi()
    {
        try {
            $sql = "SELECT * FROM PREZZI";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function getListino()
    {
        try {
            $sql = "SELECT P.ID AS id_prezzo, T.CODICE AS codice, P.VALORE AS valore, P.DATA AS data  FROM PRESTAZIONI T LEFT JOIN  PREZZI P ON T.ID = P.PRESTAZIONE ORDER BY T.CODICE ASC, P.DATA DESC";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function getListinoDic() {

        /*  Elementi del prezzario:
        prezzario = {
            CODICE : [[PREZZO1, DATA1], [PREZZO2, DATA2], ... ],
            ...
        }
        */

        try {
            $sql = "SELECT P.ID AS id_prezzo, T.CODICE AS codice, P.VALORE AS valore, P.DATA AS data  FROM PRESTAZIONI T LEFT JOIN  PREZZI P ON T.ID = P.PRESTAZIONE ORDER BY T.CODICE ASC, P.DATA DESC";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            
            $listino_temp = $stm->fetchAll();
            $listino = array();
            $i = 0;
            while($i < count($listino_temp)) {
                $codice = $listino_temp[$i]["codice"];
                $listino[$codice] = array();
                while($i < count($listino_temp) && $codice == $listino_temp[$i]["codice"]){
                    array_push($listino[$codice], [$listino_temp[$i]["valore"], $listino_temp[$i]["data"]]);
                    $i++;
                }
            }
            return $listino;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }

    }

    function getPrezzoByData($prestazione, $data)
    {

        try {
            $sql = "SELECT * FROM PREZZI WHERE prestazione = :prestazione AND data <= :data ORDER BY DATA DESC LIMIT 1";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":prestazione", $prestazione);
            $stm->bindparam(":data", $data);
            $stm->execute();
            $row_prezzo =  $stm->fetch(PDO::FETCH_ASSOC);

            if ($row_prezzo == null) {
                return 0;
            } else {
                return $row_prezzo["valore"];
            }
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function insertPrezzo($prestazione, $valore, $data)
    {
        try {
            $sql = "INSERT INTO PREZZI(prestazione, valore, data) VALUES(:prestazione, :valore, :data)";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":prestazione", $prestazione);
            $stm->bindparam(":valore", $valore);
            $stm->bindparam(":data", $data);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function deletePrezzo($id)
    {
        try {
            $sql = "DELETE FROM PREZZI WHERE id = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function updatePrezzo($id, $prestazione, $valore, $data)
    {
        try {

            if ($prestazione != NULL)
                $sql = "UPDATE PREZZI SET prestazione = :prestazione, valore = :valore, data = :data WHERE ID = :id";
            else
                $sql = "UPDATE PREZZI SET valore = :valore, data = :data WHERE ID = :id";

            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            if ($prestazione != NULL) $stm->bindparam(":prestazione", $prestazione);
            $stm->bindparam(":valore", $valore);
            $stm->bindparam(":data", $data);
            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }
}

/* Oggetto DAO */
global $pdo;
$prezzoDAO = new prezzoDAO($pdo);
