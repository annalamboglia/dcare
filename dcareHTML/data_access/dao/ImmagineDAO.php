<?php
require_once __DIR__ . "/../connection_manager/connection.php";
require_once __DIR__ . "/../../util/definitions.php";

class ImmagineDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }


    function insertImage($path, $nome, $data, $tipo_scheda, $id_scheda)
    {

        if ($tipo_scheda == SCHEDA_ORTODONTICA) {
            $sql = "INSERT INTO IMMAGINI (nome, path, data, schedaOrtodontica) VALUES (:nome, :path, :data, :id_scheda)";
        } 
        
        else if ($tipo_scheda == SCHEDA_ODONTOIATRICA) {
            $sql = "INSERT INTO IMMAGINI (nome, path, data, schedaOdontoiatrica) VALUES (:nome, :path, :data, :id_scheda)";
        }

        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":nome", $nome);
        $stm->bindparam(":path", $path);
        $stm->bindparam(":data", $data);
        $stm->bindparam(":id_scheda", $id_scheda);

        $stm->execute();
    }


    // OTTIENI TUTTE LE IMMAGINI RELATIVE AD UNA SCHEDA
    function getImages($id_scheda, $tipo_scheda)
    {

        try {

            if ($tipo_scheda == 0) {
                $sql = "SELECT * FROM IMMAGINI WHERE SCHEDAORTODONTICA = :id_scheda ORDER BY DATA DESC";
            } else if ($tipo_scheda == 1) {
                $sql = "SELECT * FROM IMMAGINI WHERE SCHEDAODONTOIATRICA = :id_scheda ORDER BY DATA DESC";
            }

            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":id_scheda", $id_scheda);
            $stm->execute();

            return $stm->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    // OTTIENI UN'IMMAGINE DATO L'ID
    function getImage($id)
    {

        try {
            $sql = "SELECT * FROM IMMAGINI WHERE ID = :id";
            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    function updatePathImage($id, $path)
    {

        $sql = "UPDATE IMMAGINI SET path = :path WHERE id = :id";
        $stm = $this->conn->prepare($sql);

        $stm->bindparam(":path", $path);
        $stm->bindparam(":id", $id);
        $stm->execute();
    }


    function updateNameImage($id, $nome)
    {

        $sql = "UPDATE IMMAGINI SET nome = :nome WHERE id = :id";
        $stm = $this->conn->prepare($sql);

        $stm->bindparam(":nome", $nome);
        $stm->bindparam(":id", $id);
        $stm->execute();
    }

    function deleteImage($id)
    {

        $sql = "DELETE FROM IMMAGINI WHERE ID = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->execute();
    }
}

/* Oggetto DAO */
global $pdo;
$immagineDAO = new ImmagineDAO($pdo);
?>