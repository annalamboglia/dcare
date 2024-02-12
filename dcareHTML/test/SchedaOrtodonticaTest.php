
<?php

include __DIR__ . "/../data_access/dao/SchedaOrtodonticaDAO.php";
include __DIR__ . "/../data_access/connection_manager/connection.php";

use PHPUnit\Framework\TestCase;

class SchedaOrtodonticaTest extends TestCase 
{
    
    public function testInsertSchedaOrtodontica()
    {
        
        $pdo = $GLOBALS["pdo"];
        $schedaortodonticaDAO= new SchedaOrtodonticaDAO($pdo);
        $last_id = 135;
        $dataApertura = '2022-02-09';
        $tipoPrestazione = 'ANA';
        $schedaortodonticaDAO->insertSchedaOrtodontica($last_id, $dataApertura, $tipoPrestazione);
        $schedeortodontiche = $schedaortodonticaDAO->getSchedeOrtodontiche($last_id);

        $schedeortodontica = $schedeortodontiche[count($schedeortodontiche)-1];

        $this->assertEquals($schedeortodontica['dataApertura'], $dataApertura);
        $this->assertEquals($schedeortodontica['tipoPrestazione'], $tipoPrestazione);



        $schedaortodonticaDAO->deleteSchedaOrtodontica($last_id);


    }

    public function testUpdateTipoPrestazione()
    {
        $pdo = $GLOBALS["pdo"];
        $schedaortodonticaDAO= new SchedaOrtodonticaDAO($pdo);
        $id_paziente = 135;
        $tipoPrestazione = 'ANA';
        $last_id = $pdo->lastInsertId();

        $schedaortodonticaDAO->updateTipoPrestazione($id_paziente, $tipoPrestazione);
        $schedeortodontiche = $schedaortodonticaDAO->getSchedeOrtodontiche($id_paziente);

        $schedeortodontica = $schedeortodontiche[count($schedeortodontiche)-1];

        $this->assertEquals($schedeortodontica['tipoPrestazione'], $tipoPrestazione);

    }


    public function testDeleteSchedaOdontoiatrica()
    {
        
        $pdo = $GLOBALS["pdo"];
        $schedaortodonticaDAO= new SchedaOrtodonticaDAO($pdo);
        $id_paziente = 135;


        $dataApertura = '2022-03-09';
        $tipoPrestazione = 'ANA';
        $schedaortodonticaDAO->insertSchedaOrtodontica($id_paziente, $dataApertura, $tipoPrestazione);


        $last_id = $pdo->lastInsertId();
        $schedaortodonticaDAO->deleteSchedaOrtodontica($last_id);

        $schedeortodontiche = $schedaortodonticaDAO->getSchedeOrtodontiche($id_paziente);
        $id_corrente=count($schedeortodontiche)-1;
        $this->assertNotEquals($last_id, $id_corrente);

    }
    

}