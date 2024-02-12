<?php
require_once __DIR__ . "/../connection_manager/connection.php";

class PazienteDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function insertPaziente($nome, $cognome, $dataNascita, $residenza, $provincia, $cap, $telefono, $cellulare, $email)
    {

        try {


            $sql = "INSERT INTO PAZIENTI(nome, cognome, dataNascita, residenza, provincia, cap, telefono, cellulare, email, cestino) VALUES(:nome, :cognome, :dataNascita, :residenza, :provincia, :cap, :telefono, :cellulare, :email, 0);";
            $stm = $this->conn->prepare($sql);


            $stm->bindparam(":nome", $nome);
            $stm->bindparam(":cognome", $cognome);
            $stm->bindparam(":residenza", $residenza);
            $stm->bindparam(":provincia", $provincia);
            $stm->bindparam(":cap", $cap);
            $stm->bindparam(":telefono", $telefono);
            $stm->bindparam(":cellulare", $cellulare);
            $stm->bindparam(":email", $email);

            if ($dataNascita != "") {
                $stm->bindparam(":dataNascita", $dataNascita);
            } else {
                $null = "NULL";
                $stm->bindparam(":dataNascita", $null, PDO::PARAM_NULL);
            }

            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getPazienti()
    {

        try {

            $sql = "SELECT * FROM PAZIENTI ORDER BY COGNOME, NOME";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getPazientiNoCestinati()
    {

        try {

            $sql = "SELECT * FROM PAZIENTI WHERE CESTINO = 0 ORDER BY COGNOME, NOME";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

            return $stm->fetchall();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getPazientiCestinati()
    {

        try {

            $sql = "SELECT * FROM PAZIENTI WHERE CESTINO = 1 ORDER BY COGNOME, NOME";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

            return $stm->fetchall();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getPaziente($id)
    {

        try {
            $sql = "SELECT * FROM PAZIENTI WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }



    // Join taballe Pazienti e Paganti
    public function getInfoPaziente($id)
    {

        try {

            $sql = "SELECT PA.ID AS id, 
            PA.NOME AS nome, 
            PA.COGNOME AS cognome, 
            PA.DATANASCITA AS dataNascita, 
            PA.RESIDENZA AS residenza, 
            PA.PROVINCIA AS provincia,
            PA.CAP AS cap, 
            PA.TELEFONO AS telefono, 
            PA.CELLULARE AS cellulare, 
            PA.EMAIL AS email,
            PA.CESTINO AS cestino,
            PG.id AS pagante,
            PG.NOME AS pnome,
            PG.COGNOME AS pcognome,
            PG.SESSO AS psesso,
            PG.CITTANASCITA AS pcittaNascita,
            PG.DATANASCITA AS pdataNascita,
            PG.PROVINCIANASCITA AS pprovinciaNascita,
            PG.RESIDENZA AS presidenza,
            PG.PROVINCIA AS pprovincia,
            PG.CAP AS pcap,
            PG.PRESTAZIONI AS pprestazioni,
            PG.CF AS pcf
            FROM PAZIENTI PA LEFT JOIN PAGANTI PG ON PG.PAZIENTE = PA.ID WHERE PA.ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    public function updatePaziente($id, $nome, $cognome, $dataNascita, $residenza, $provincia, $cap, $telefono, $cellulare, $email)
    {
        try {

            $sql = "UPDATE PAZIENTI 
            SET nome = :nome, cognome = :cognome, dataNascita = :dataNascita, residenza = :residenza, provincia = :provincia, cap = :cap, telefono = :telefono, cellulare = :cellulare, email = :email
            WHERE id = :id";

            $stm = $this->conn->prepare($sql);

            $stm->bindparam(":nome", $nome);
            $stm->bindparam(":cognome", $cognome);
            $stm->bindparam(":residenza", $residenza);
            $stm->bindparam(":provincia", $provincia);
            $stm->bindparam(":cap", $cap);
            $stm->bindparam(":telefono", $telefono);
            $stm->bindparam(":cellulare", $cellulare);
            $stm->bindparam(":email", $email);
            $stm->bindparam(":id", $id);


            if ($dataNascita != "") {
                $stm->bindparam(":dataNascita", $dataNascita);
            } else {
                $null = "NULL";
                $stm->bindparam(":dataNascita", $null, PDO::PARAM_NULL);
            }


            $stm->execute();
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    public function deletePaziente($id)
    {
        try {

            $sql = "DELETE FROM PAZIENTI WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function deleteCestino()
    {

        try {

            $sql = "DELETE FROM PAZIENTI WHERE CESTINO = 1";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }


    public function moveCestino($id)
    {
        try {

            $sql = "UPDATE PAZIENTI SET CESTINO = 1 WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function ripristinaPaziente($id)
    {
        try {

            $sql = "UPDATE PAZIENTI SET CESTINO = 0 WHERE ID = :id";
            $stm = $this->conn->prepare($sql);
            $stm->bindparam(":id", $id);
            $stm->execute();

            return $stm;
        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

    public function getCestino()
    {

        try {

            $sql = "SELECT * FROM PAZIENTI WHERE CESTINO = 1";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

            return $stm->fetchall();

        } catch (PDOException $e) {
            throw new PDOException(($e->getMessage()));
        }
    }

}

/* Oggetto DAO */
global $pdo;
$pazienteDAO = new PazienteDAO($pdo);
?>