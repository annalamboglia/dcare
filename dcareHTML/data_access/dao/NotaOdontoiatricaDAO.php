<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class NotaOdontoiatricaDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getDiario($scheda) {

        try {

            $sql = "SELECT D.ID AS id, D.ED AS ed, T.CODICE AS codice, T.NOME as prestazione, D.NOTE AS note, D.STATO AS stato, D.DATA AS data
                    FROM NOTEODONTOIATRICHE D JOIN PRESTAZIONI T ON D.PRESTAZIONE = T.ID 
                    WHERE scheda = :scheda ORDER BY DATA DESC";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":scheda", $scheda);
            $stm->execute();

            return $stm->fetchAll();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }

    }

    public function insertNotaOdontoiatrica($scheda, $ed, $prestazione, $note, $stato, $data) {
        
        try {


            $sql = "INSERT INTO NOTEODONTOIATRICHE (scheda, ed, prestazione, note, stato, data) VALUES (:scheda, :ed, :prestazione, :note, :stato, :data)";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":scheda", $scheda);
            $stm->bindparam(":ed", $ed);
            $stm->bindparam(":prestazione", $prestazione);
            $stm->bindparam(":note", $note);
            $stm->bindparam(":stato", $stato);
            $stm->bindparam(":data", $data);

            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function updateNotaOdontoiatrica($id, $ed, $prestazione, $note, $stato, $data) {

        try {


            $sql = "UPDATE NOTEODONTOIATRICHE SET  ed = :ed, prestazione = :prestazione, note = :note, stato = :stato, data = :data WHERE id = :id";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":ed", $ed);
            $stm->bindparam(":prestazione", $prestazione);
            $stm->bindparam(":note", $note);
            $stm->bindparam(":stato", $stato);
            $stm->bindparam(":data", $data);
            $stm->bindparam(":id", $id);


            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function deleteNotaOdontoiatrica($id) {

        try {
            $sql = "DELETE FROM NOTEODONTOIATRICHE WHERE id = :id";
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
$notaOdontoiatricaDAO = new NotaOdontoiatricaDAO($pdo);
?>