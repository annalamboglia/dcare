
<?php

include __DIR__ . "/../data_access/dao/PazienteDAO.php";
include __DIR__ . "/../data_access/connection_manager/connection.php";

use PHPUnit\Framework\TestCase;

class PazienteTest extends TestCase 
{
    
    public function testInsertPaziente()
    {
        
        //Precondizione 
        //Necessito di un oggetto paziente
        $pdo = $GLOBALS["pdo"];
        $pazienteDAO = new PazienteDAO($pdo);

        //Dati del paziente da inserire
        $nome = 'Aron Olson';
        $cognome ='Ritchie';
        $dataNascita='2019-05-11';
        $residenza='Sipesberg';
        $provincia='Montana';
        $cap='77152';
        $telefono='(860)697-4852x1';
        $cellulare='982-905-1998x70';
        $email='lacey29@dietrichmosciski.com';

        //Inserimento del paziente
        $pazienteDAO->insertPaziente($nome,$cognome,$dataNascita,$residenza,$provincia,$cap,$telefono,$cellulare,$email);
        $last_id = $pdo->lastInsertId();
        $paziente = $pazienteDAO->getPaziente($last_id);

        //asserzioni
        $this->assertEquals($nome, $paziente["nome"]);
        $this->assertEquals($cognome, $paziente["cognome"]);
        $this->assertEquals($dataNascita, $paziente["dataNascita"]);
        $this->assertEquals($residenza, $paziente["residenza"]);
        $this->assertEquals($cap, $paziente["cap"]);
        $this->assertEquals($cellulare, $paziente["cellulare"]);
        $this->assertEquals($email, $paziente["email"]);

        //Ripristino del sistema
        //Elimino il paziente appena inserito
        $pazienteDAO->deletePaziente($last_id);

    }


    public function testUpdatePaziente()
    {
        //Precondizione 
        //Ho bisogno di un paziente nel sistema
        $pdo = $GLOBALS["pdo"];
        $pazienteDAO = new PazienteDAO($pdo);
        //Dati del paziente da inserire
        $nome = 'Aron Olson';
        $cognome ='Ritchie';
        $dataNascita='2019-05-11';
        $residenza='Sipesberg';
        $provincia='Montana';
        $cap='77152';
        $telefono='(860)697-4852x1';
        $cellulare='982-905-1998x70';
        $email='lacey29@dietrichmosciski.com';
        $pazienteDAO->insertPaziente($nome,$cognome,$dataNascita,$residenza,$provincia,$cap,$telefono,$cellulare,$email);

        //Modifico nome e cognome del paziente
        $nome_modificato = 'Caterina';
        $cognome_modificato ='Valente';
        $last_id = $pdo->lastInsertId();
        $pazienteDAO->updatePaziente($last_id,$nome_modificato,$cognome,'2019-05-11','Sipesberg','Montana','77152','(860)697-4852x1','982-905-1998x70','lacey29@dietrichmosciski.com');
        $paziente = $pazienteDAO->getPaziente($last_id);
        //Asserzioni
        $this->assertEquals($nome_modificato, $paziente["nome"]);
        $this->assertEquals($cognome_modificato, $paziente["cognome"]);

        //Ripristino del sistema
        //Elimino il paziente appena inserito
        $pazienteDAO->deletePaziente($last_id);

    }


    public function testDeletePaziente()
    {

        //Precondizione 
        //Ho bisogno di un paziente nel sistema
        $pdo = $GLOBALS["pdo"];
        $pazienteDAO = new PazienteDAO($pdo);
        //Dati del paziente da inserire
        $nome = 'Aron Olson';
        $cognome ='Ritchie';
        $dataNascita='2019-05-11';
        $residenza='Sipesberg';
        $provincia='Montana';
        $cap='77152';
        $telefono='(860)697-4852x1';
        $cellulare='982-905-1998x70';
        $email='lacey29@dietrichmosciski.com';
        $pazienteDAO->insertPaziente($nome,$cognome,$dataNascita,$residenza,$provincia,$cap,$telefono,$cellulare,$email);


        //Elimino il paziente
        $last_id = $pdo->lastInsertId();
        $pazienteDAO->deletePaziente($last_id);
        $last_id_2 = $pdo->lastInsertId();
        $paziente = $pazienteDAO->getPaziente($last_id_2);
        //Asserzione
        $this->assertEquals($last_id, $last_id_2);


    }

    public function testMoveCestino()
    {
        $pdo = $GLOBALS["pdo"];
        $pazienteDAO = new PazienteDAO($pdo);
        $pazienteDAO->insertPaziente('Aron Olson','Ritchie','2019-05-11','Sipesberg','Montana','77152','(860)697-4852x1','982-905-1998x70','lacey29@dietrichmosciski.com');
        $last_id = $pdo->lastInsertId();
        $pazienteDAO->moveCestino($last_id);
        $paziente = $pazienteDAO->getPaziente($last_id);
        $this->assertEquals(1, $paziente['cestino']);

    }

    
    public function testRipristinaPaziente()
    {
        $pdo = $GLOBALS["pdo"];
        $pazienteDAO = new PazienteDAO($pdo);
        $pazienteDAO->insertPaziente('Aron Olson','Ritchie','2019-05-11','Sipesberg','Montana','77152','(860)697-4852x1','982-905-1998x70','lacey29@dietrichmosciski.com');
        $last_id = $pdo->lastInsertId();
        $pazienteDAO->moveCestino($last_id);
        $pazienteDAO->ripristinaPaziente($last_id);
        $paziente = $pazienteDAO->getPaziente($last_id);
        $this->assertEquals(0, $paziente['cestino']);

    }


    public function testDeleteCestino()
    {
        $pdo = $GLOBALS["pdo"];
        $pazienteDAO = new PazienteDAO($pdo);
        $pazienteDAO->deleteCestino();
        $pazienti = $pazienteDAO->getCestino();
        $nPazienti = count($pazienti);
        $this->assertEquals(0, $nPazienti);

    }
    
    
}