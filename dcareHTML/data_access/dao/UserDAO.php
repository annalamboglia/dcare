<?php

require_once __DIR__."/../connection_manager/connection.php";

class UserDAO
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertUser($password, $email, $role)
    {
        $sql = "INSERT INTO USERS (password, email, role) VALUES (:password, :email, :role)";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":password", $password);
        $stm->bindparam(":email", $email);
        $stm->bindparam(":email", $role);
        $stm->execute();
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM USERS WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->execute();
    }

    public function updateNickname($id, $nick)
    {
        $sql = "UPDATE USERS SET nick = :nick WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->bindparam(":nick", $nick);
        $stm->execute();
    }

    public function updatePassword($id, $password)
    {
        $sql = "UPDATE USERS SET password = :password WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->bindparam(":password", $password);
        $stm->execute();
    }

    public function updateRole($id, $role)
    {
        $sql = "UPDATE USERS SET role = :role WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->bindparam(":role", $role);
        $stm->execute();
    } 

    public function getUsers()
    {
        $sql = "SELECT * FROM USERS";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM USERS WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":id", $id);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByNick($nick)
    {
        $sql = "SELECT * FROM USERS WHERE nickname = :nick";
        $stm = $this->conn->prepare($sql);
        $stm->bindparam(":nick", $nick);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

}

/* Oggetto DAO */
global $pdo;
$userDAO = new UserDAO($pdo);
?>