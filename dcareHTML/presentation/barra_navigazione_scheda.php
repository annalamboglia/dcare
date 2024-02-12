<!-- Requires $s riferimento ad una scheda con campi id_paziente -->
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

    <li class="nav-item mr-3">
        <a class="btn btn-primary" href="cartella_clinica.php?id=<?php echo ($id_paziente); ?>"><span class="fas fa-arrow-left"></span></a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?php if (isset($_GET["scheda"])) echo ("active") ?>" id="pills-scheda-tab" data-toggle="pill" href="#pills-scheda">Scheda</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?php if (isset($_GET["contabilita"])) echo ("active") ?>" id="pills-contabilita-tab" data-toggle="pill" href="#pills-contabilita">Contabilità</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link <?php if (isset($_GET["immagini"])) echo ("active") ?>" id="pills-contabilita-tab" data-toggle="pill" href="#pills-immagini">Immagini</a>
    </li>
    <li class="nav-item" role="presentation">
        <div class="btn btn-primary ml-3" data-toggle="modal" data-target="#modalApriScheda">
            <div class="fas fa-share"></div>
        </div>
    </li>
    <li class="nav-item d-flex flex-grow-1 flex-row-reverse" role="presentation">
        <h3 class="my-3 text-right text-small" style="font-size: 15px;">Scheda ID: <?php echo ($_GET["id"]); ?></h3>
    </li>


</ul>