<!-- 
    Header della scheda (Nome paziente, data apertura, ultimo accesso) 

    Require:
    $s: informazioni della scheda
        
        -----
        Campi
        -----
        nome 
        cognome
        dataApertura
        dataUltimoAccesso
-->

<h5 class="card-text">Paziente: <?php echo ($s["nome"] . " " . $s["cognome"]); ?></h5>
<h5 class="card-text">Data apertura: <?php echo ($s["dataApertura"]); ?></h5>
<h5 class="card-text">Ultimo accesso:
    <?php if ($s["dataUltimoAccesso"] == null) {
        echo ("Primo accesso");
    } else {
        echo (date("d-m-Y", strtotime($s["dataUltimoAccesso"])));
    }
    ?>
</h5>