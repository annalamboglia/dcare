<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class NotaOrtodonticaDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertNotaOrtodontica($scheda, $data, $testo) {
        try {

            $sql = "INSERT INTO NOTEORTODONTICHE (schedaOrtodontica, data, testo) VALUES (:scheda, :data, :testo)";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":scheda", $scheda);
            $stm->bindparam(":data", $data);
            $stm->bindparam(":testo", $testo);

            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    // OTTINI DIARIO DI UNA SCHEDA
    public function getDiario($id_scheda) {

        try {

            $sql = "SELECT * FROM NOTEORTODONTICHE WHERE schedaOrtodontica = :id ORDER BY id DESC, data DESC";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id_scheda);
            $stm->execute();

            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function updateNotaOrtodontica($id, $data, $testo) {
        try {
            $sql = "UPDATE NOTEORTODONTICHE SET data = :data, testo = :testo WHERE id = :id";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":data", $data);
            $stm->bindparam(":testo", $testo);
            $stm->bindparam(":id", $id);
            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function deleteNotaOrtodontica($id) {
        try {
            $sql = "DELETE FROM NOTEORTODONTICHE WHERE id = :id";
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
$notaOrtodonticaDAO = new NotaOrtodonticaDAO($pdo);
?>