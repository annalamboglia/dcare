
<?php

include __DIR__ . "/../data_access/dao/SchedaOdontoiatricaDAO.php";
include __DIR__ . "/../data_access/connection_manager/connection.php";

use PHPUnit\Framework\TestCase;

class SchedaOdontoiatricaTest extends TestCase 
{

    public function testInsertSchedaOdontoiatrica()
    {
        
        $pdo = $GLOBALS["pdo"];
        $schedaodontoiatricaDAO= new SchedaOdontoiatricaDAO($pdo);
        $last_id = 135;
        $dataApertura = '2022-02-09';
        $tipoPrestazione = 'scheda 3';
        $schedaodontoiatricaDAO->insertSchedaOdontoiatrica($last_id, $dataApertura, $tipoPrestazione);
        $schedeodontoiatriche = $schedaodontoiatricaDAO->getSchedeOdontoiatriche($last_id);

        $schedeodontoiatrica = $schedeodontoiatriche[count($schedeodontoiatriche)-1];

        $this->assertEquals($schedeodontoiatrica['dataApertura'], $dataApertura);
        $this->assertEquals($schedeodontoiatrica['tipoPrestazione'], $tipoPrestazione);


        $schedaodontoiatricaDAO->deleteSchedaOdontoiatrica($last_id);

    }

    public function testUpdateTipoPrestazione()
    {
        $pdo = $GLOBALS["pdo"];
        $schedaodontoiatricaDAO= new SchedaOdontoiatricaDAO($pdo);
        $last_id = 135;
        $tipoPrestazione = 'CF';

        $dataApertura = '2022-02-09';
        $tipoPrestazione = 'scheda 3';
        $schedaodontoiatricaDAO->insertSchedaOdontoiatrica(135, $dataApertura, $tipoPrestazione);

        $schedaodontoiatricaDAO->updateTipoPrestazione($last_id, $tipoPrestazione);
        $schedeodontoiatriche = $schedaodontoiatricaDAO->getSchedeOdontoiatriche($last_id);
        $schedeodontoiatrica = $schedeodontoiatriche[count($schedeodontoiatriche)-1];

        $this->assertEquals($schedeodontoiatrica['tipoPrestazione'], $tipoPrestazione);

        $schedaodontoiatricaDAO->deleteSchedaOdontoiatrica($last_id);

    }

    
    public function testDeleteSchedaOdontoiatrica()
    {
        $pdo = $GLOBALS["pdo"];
        $schedaodontoiatricaDAO= new SchedaOdontoiatricaDAO($pdo);
        $id_paziente = 135;


        $dataApertura = '2022-03-09';
        $tipoPrestazione = 'ANA';
        $schedaodontoiatricaDAO->insertSchedaOdontoiatrica($id_paziente, $dataApertura, $tipoPrestazione);

        $nome='Matteo';
        $cognome='Rossi';
        $data='2022-03-09';
        $last_id = $pdo->lastInsertId();
        $schedaodontoiatricaDAO->deleteSchedaOdontoiatrica($last_id);
        $schedeodontoiatriche = $schedaodontoiatricaDAO->getSchedeOdontoiatriche($id_paziente);
        $id_corrente=count($schedeodontoiatriche)-1;
        $this->assertNotEquals($last_id, $id_corrente);

        
    }
    
}