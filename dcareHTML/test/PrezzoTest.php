
<?php

include __DIR__ . "/../data_access/dao/PrezzoDAO.php";
include __DIR__ . "/../data_access/dao/PazienteDAO.php";
include __DIR__ . "/../data_access/connection_manager/connection.php";

use PHPUnit\Framework\TestCase;

class PrezzoTest extends TestCase 
{
    
    public function testInsertPrezzo()
    {
        $pdo = $GLOBALS["pdo"];
        $prezzoDAO= new PrezzoDAO($pdo);
        $prestazione = 30;
        $data = '2022-03-10';
        $valore = '12.00';
        $prezzoDAO->insertPrezzo($prestazione, $valore, $data);
        $prezzi = $prezzoDAO->getPrezzi();
        $prezzo = $prezzi[count($prezzi)-1];

        $this->assertEquals($prezzo['prestazione'], $prestazione);
        $this->assertEquals($prezzo['valore'], $valore);
        $this->assertEquals($prezzo['data'], $data);


    }

    public function testUpdatePrezzo()
    {
        
        $pdo = $GLOBALS["pdo"];
        $prezzoDAO= new PrezzoDAO($pdo);
        $prestazione = 20;
        $data = '2022-03-09';
        $valore = '18.00';
        $prezzoDAO->insertPrezzo($prestazione, $valore, $data);
        $last_id = $pdo->lastInsertId();
        $prezzoDAO->updatePrezzo($last_id, $prestazione, $valore, $data);
        $prezzi = $prezzoDAO->getPrezzi();
        $prezzo = $prezzi[count($prezzi)-1];

        $this->assertEquals($prezzo['prestazione'], $prestazione);
        $this->assertEquals($prezzo['valore'], $valore);
        $this->assertEquals($prezzo['data'], $data);
    }


    public function testDeletePrezzo()
    {
        
        $pdo = $GLOBALS["pdo"];
        $prezzoDAO= new PrezzoDAO($pdo);
        $prestazione = 20;
        $data = '2022-03-09';
        $valore = '18.00';
        $prezzoDAO->insertPrezzo($prestazione, $valore, $data);
        $last_id = $pdo->lastInsertId();;
        $prezzoDAO->deletePrezzo($last_id);
        $prezzi = $prezzoDAO->getPrezzi();

        $ok=0;
        foreach ($prezzi as $prezzo) {
            if ($prezzo['id']==20) {
               $ok=1;
           }
        }
        $this->assertEquals(0, $ok);

    }
    

}