
<?php

include __DIR__ . "/../data_access/dao/AppuntamentoDAO.php";
include __DIR__ . "/../data_access/connection_manager/connection.php";

use PHPUnit\Framework\TestCase;

class AppuntamentoTest extends TestCase 
{
    private $last_id;

    public function testInsertAppuntamento()
    {
        $pdo = $GLOBALS["pdo"];
        $appuntamentoDAO= new AppuntamentoDAO($pdo);
        $nome='Aron Olson';
        $cognome='Ritchie';
        $data='2022-03-09';
        $appuntamentoDAO->insertAppuntamento($nome,$cognome,'Pulizia',$data);
        $appuntamenti = $appuntamentoDAO->getAppuntamenti($data);
        $this->last_id = $pdo->lastInsertId();
        
        $ok=0;

        foreach ($appuntamenti as $appuntamento) {

           if ($appuntamento['nome']==$nome && $appuntamento['cognome']==$cognome) {
               $ok=1;
           }
        }
        $this->assertEquals(1, $ok);

    }

    public function testUpdateAppuntamento()
    {
        $pdo = $GLOBALS["pdo"];
        $appuntamentoDAO= new AppuntamentoDAO($pdo);
        $nome='Mattia';
        $cognome='Rossi';
        $data='2022-03-09';
        $appuntamentoDAO->insertAppuntamento($nome,$cognome,'Pulizia',$data);
        $this->last_id = $pdo->lastInsertId();
        $appuntamentoDAO->updateAppuntamento($this->last_id,$nome,$cognome,'Pulizia',$data);
        $appuntamenti = $appuntamentoDAO->getAppuntamenti($data);


        $ok=0;
        foreach ($appuntamenti as $appuntamento) {
           if ($appuntamento['nome']==$nome && $appuntamento['cognome']==$cognome) {
               $ok=1;
           }
        }
        $this->assertEquals(1, $ok);

    }


    public function testDeleteAppuntamento()
    {
        $pdo = $GLOBALS["pdo"];
        $appuntamentoDAO= new AppuntamentoDAO($pdo);
        $nome='Matteo';
        $cognome='Rossi';
        $data='2022-03-09';
        $appuntamentoDAO->deleteAppuntamento($this->last_id);
        $appuntamenti = $appuntamentoDAO->getAppuntamenti($data);


        $ok=0;
        foreach ($appuntamenti as $appuntamento) {
           if ($appuntamento['nome']==$nome && $appuntamento['cognome']==$cognome) {
               $ok=1;
           }
        }
        $this->assertEquals(0, $ok);

    }

}