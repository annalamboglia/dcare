<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class PaganteDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function insertPagante($nome, $cognome, $sesso, $cittaNascita, $dataNascita, $provinciaNascita, $residenza, $provincia, $cap, $prestazioni, $cf, $paziente)
    {

        try {

            $sql = "INSERT INTO PAGANTI(nome, cognome, sesso, cittaNascita, dataNascita, provinciaNascita, residenza, provincia, cap, prestazioni, cf, paziente) VALUES(:nome, :cognome, :sesso, :cittaNascita, :dataNascita, :provinciaNascita, :residenza, :provincia, :cap, :prestazioni, :cf, :paziente);";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":nome", $nome);
            $stm->bindparam(":cognome", $cognome);
            $stm->bindparam(":sesso", $sesso);
            $stm->bindparam(":cittaNascita", $cittaNascita);
            $stm->bindparam(":provinciaNascita", $provinciaNascita);
            $stm->bindparam(":residenza", $residenza);
            $stm->bindparam(":provincia", $provincia);
            $stm->bindparam(":cap", $cap);
            $stm->bindparam(":prestazioni", $prestazioni);
            $stm->bindparam(":cf", $cf);
            $stm->bindparam(":paziente", $paziente);


            if($dataNascita != "") {
                $stm->bindparam(":dataNascita", $dataNascita);
            }
            else {
                $null = "NULL";
                $stm->bindparam(":dataNascita", $null, PDO::PARAM_NULL);
            }

            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    public function getPaganti()
    {

        try {

            $sql = "SELECT * FROM PAGANTI";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    public function getPagante($id)
    {

        try {

            $sql = "SELECT * FROM PAGANTI WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }



    public function updatePagante($id, $nome, $cognome, $sesso, $cittaNascita, $dataNascita, $provinciaNascita, $residenza, $provincia, $cap, $prestazioni, $cf)
    {


        try {

            $sql = "UPDATE PAGANTI  
            SET nome = :nome, cognome = :cognome, sesso = :sesso, cittaNascita = :cittaNascita, dataNascita = :dataNascita, provinciaNascita = :provinciaNascita, residenza = :residenza, provincia = :provincia, cap = :cap, prestazioni = :prestazioni, cf = :cf
            WHERE id = :id";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":nome", $nome);
            $stm->bindparam(":cognome", $cognome);
            $stm->bindparam(":sesso", $sesso);
            $stm->bindparam(":cittaNascita", $cittaNascita);
            $stm->bindparam(":provinciaNascita", $provinciaNascita);
            $stm->bindparam(":residenza", $residenza);
            $stm->bindparam(":provincia", $provincia);
            $stm->bindparam(":cap", $cap);
            $stm->bindparam(":prestazioni", $prestazioni);
            $stm->bindparam(":cf", $cf);
            $stm->bindparam(":id", $id);


            if($dataNascita != "") {
                $stm->bindparam(":dataNascita", $dataNascita);
            }
            else {
                $null = "NULL";
                $stm->bindparam(":dataNascita", $null, PDO::PARAM_NULL);
            }


            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }
}

/* Oggetto DAO */
global $pdo;
$paganteDAO = new PaganteDAO($pdo);
?>