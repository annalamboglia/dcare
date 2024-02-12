<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class AppuntamentoDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAppuntamenti($data) {
        try {
            $sql = "SELECT * FROM APPUNTAMENTI WHERE DATE(datatime) = :data";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":data", $data);
            $stm->execute();
            if($stm != FALSE) return $stm->fetchAll(PDO::FETCH_ASSOC);
            else return NULL;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function insertAppuntamento($nome, $cognome, $note, $datatime) {
        try {


            $sql = "INSERT INTO APPUNTAMENTI (nome, cognome, note, datatime) VALUES (:nome, :cognome, :note, :datatime)";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":nome", $nome);
            $stm->bindparam(":cognome", $cognome);
            $stm->bindparam(":note", $note);
            $stm->bindparam(":datatime", $datatime);
            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function updateAppuntamento($id, $nome, $cognome, $note, $datatime) {

        try {
             $sql = "UPDATE APPUNTAMENTI SET  nome = :nome, cognome = :cognome, note = :note, datatime = :datatime WHERE id = :id";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":id", $id);
            $stm->bindparam(":nome", $nome);
            $stm->bindparam(":cognome", $cognome);
            $stm->bindparam(":note", $note);
            $stm->bindparam(":datatime", $datatime);


            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    public function deleteAppuntamento($id) {

        try {
            $sql = "DELETE FROM APPUNTAMENTI WHERE id = :id";
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
$appuntamentoDAO = new AppuntamentoDAO($pdo);
?>