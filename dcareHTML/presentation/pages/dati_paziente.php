<!DOCTYPE html>
<?php

require __DIR__ . "/../../business_logic/permissionManager.php";

if (isset($_GET["id"])) {

    require_once __DIR__ . "/../../data_access/dao/PazienteDAO.php";

    $p = $pazienteDAO->getInfoPaziente($_GET["id"]);

    // DATI PAZIENTE
    $id = $_GET["id"];
    $nome = $p["nome"];
    $cognome = $p["cognome"];
    $dataNascita = $p["dataNascita"];
    $residenza = $p["residenza"];
    $provincia = $p["provincia"];
    $cap = $p["cap"];
    $telefono = $p["telefono"];
    $cellulare = $p["cellulare"];
    $email = $p["email"];

    // DATI PAGENTE
    $pagante = $p["pagante"];
    $pnome = $p["pnome"];
    $pcognome = $p["pcognome"];
    $psesso = $p["psesso"];
    $pcittaNascita = $p["pcittaNascita"];
    $pdataNascita = $p["pdataNascita"];
    $pprovinciaNascita = $p["pprovinciaNascita"];
    $presidenza = $p["presidenza"];
    $pprovincia = $p["pprovincia"];
    $pcap = $p["pcap"];
    $pprestazioni = $p["pprestazioni"];
    $pcf = $p["pcf"];
} else {
    $id = "";
    $nome = "";
    $cognome = "";
    $dataNascita = "";
    $residenza = "";
    $provincia = "";
    $cap = "";
    $telefono = "";
    $cellulare = "";
    $email = "";

    // DATI PAGENTE
    $pagante = "";
    $pnome = "";
    $pcognome = "";
    $psesso = "";
    $pcittaNascita = "";
    $pdataNascita = "";
    $pprovinciaNascita = "";
    $presidenza = "";
    $pprovincia = "";
    $pcap = "";
    $pprestazioni = "";
    $pcf = "";
}

/* ARRAY DI OPTION PRONVINCE*/
$option = array("ag", "Agrigento", "al", "Alessandria", "an", "Ancona", "ao", "Aosta", "ar", "Arezzo", "ap", "Ascoli Piceno", "at", "Asti", "av", "Avellino", "ba", "Bari", "bt", "Barletta-Andria-Trani", "bl", "Belluno", "bn", "Benevento", "bg", "Bergamo", "bi", "Biella", "bo", "Bologna", "bz", "Bolzano", "bs", "Brescia", "br", "Brindisi", "ca", "Cagliari", "cl", "Caltanissetta", "cb", "Campobasso", "ci", "Carbonia-iglesias", "ce", "Caserta", "ct", "Catania", "cz", "Catanzaro", "ch", "Chieti", "co", "Como", "cs", "Cosenza", "cr", "Cremona", "kr", "Crotone", "cn", "Cuneo", "en", "Enna", "fm", "Fermo", "fe", "Ferrara", "fi", "Firenze", "fg", "Foggia", "fc", "Forl&igrave;-Cesena", "fr", "Frosinone", "ge", "Genova", "go", "Gorizia", "gr", "Grosseto", "im", "Imperia", "is", "Isernia", "sp", "La spezia", "aq", "L'aquila", "lt", "Latina", "le", "Lecce", "lc", "Lecco", "li", "Livorno", "lo", "Lodi", "lu", "Lucca", "mc", "Macerata", "mn", "Mantova", "ms", "Massa-Carrara", "mt", "Matera", "vs", "Medio Campidano", "me", "Messina", "mi", "Milano", "mo", "Modena", "mb", "Monza e della Brianza", "na", "Napoli", "no", "Novara", "nu", "Nuoro", "og", "Ogliastra", "ot", "Olbia-Tempio", "or", "Oristano", "pd", "Padova", "pa", "Palermo", "pr", "Parma", "pv", "Pavia", "pg", "Perugia", "pu", "Pesaro e Urbino", "pe", "Pescara", "pc", "Piacenza", "pi", "Pisa", "pt", "Pistoia", "pn", "Pordenone", "pz", "Potenza", "po", "Prato", "rg", "Ragusa", "ra", "Ravenna", "rc", "Reggio di Calabria", "re", "Reggio nell'Emilia", "ri", "Rieti", "rn", "Rimini", "rm", "Roma", "ro", "Rovigo", "sa", "Salerno", "ss", "Sassari", "sv", "Savona", "si", "Siena", "sr", "Siracusa", "so", "Sondrio", "ta", "Taranto", "te", "Teramo", "tr", "Terni", "to", "Torino", "tp", "Trapani", "tn", "Trento", "tv", "Treviso", "ts", "Trieste", "ud", "Udine", "va", "Varese", "ve", "Venezia", "vb", "Verbano-Cusio-Ossola", "vc", "Vercelli", "vr", "Verona", "vv", "Vibo valentia", "vi", "Vicenza", "vt", "Viterbo", "ee", "Estero");
?>


<html lang="it">

<head>

    <?php require_once __DIR__ . "/../header.html"; ?>

    <!-- Script per il calcolo del codice fiscale -->
    <script src="/business_logic/codiceFiscale/codice.fiscale.var.js"></script>


    <title>Dcare: Dati paziente</title>

</head>




<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Including Sidebar -->
        <?php require __DIR__ . "/..//sidebar.html" ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Including Topbar -->
            <?php require __DIR__ . "/../topbar.php" ?>


            <!-- begin main page -->
            <div class="container-fluid mx-3">

                <!-- Form dati anagrafici -->
                <form action="/business_logic/managerPazienti.php?<?php echo ("id_paziente=$id&id_pagante=$pagante"); ?>" method="POST">

                    <!-- contenitore carte -->
                    <div class="container-fluid">

                        <!-- Card Dati anagfrafici -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Dati anagrafici</h5>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Nome</label>
                                        <input maxlength="15" type="text" class="form-control" name="nome" required="true" value=<?php echo ("'$nome'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Cognome</label>
                                        <input maxlength="20" type="text" class="form-control" name="cognome" required="true" value=<?php echo ("'$cognome'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Data di nascita</label>
                                        <input type="date" class="form-control" placeholder="gg/mm/aaaa" name="dataNascita" value=<?php echo ("'$dataNascita'") ?>>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Residente in</label>
                                        <input maxlength="45" type="text" class="form-control" placeholder="Comune" name="residenza" value=<?php echo ("'$residenza'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Provincia</label>
                                        <select class="form-control" placeholder="--" name="provincia">

                                            <!-- SELECTED SELEZIONA SE E' AGGIUNGI PAZIENTE, ALTRIMENTI LA PROVINCIA -->
                                            <option <?php if (!isset($_GET['id'])) echo ("selected='selected'"); ?> value="">-Seleziona-</option>
                                            <?php
                                            for ($i = 0; $i < count($option); $i = $i + 2) {
                                                if (isset($_GET["id"]) && $provincia == $option[$i]) {
                                                    echo ("<option value='$option[$i]' selected='selected'>" . $option[$i + 1] . "</option>");
                                                } else {
                                                    echo ("<option value='$option[$i]'>" . $option[$i + 1] . "</option>");
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">CAP</label>
                                        <input type="text" class="form-control" maxlength="5" name="cap" value=<?php echo ("'$cap'") ?>>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-sm-12 col-md-3 mb-3">
                                        <label class="form-label text-nowrap">Telefono fisso</label>
                                        <input maxlength="15" type="text" class="form-control" name="telefono" value=<?php echo ("'$telefono'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-3 mb-3">
                                        <label class="form-label">Cellulare</label>
                                        <input maxlength="15" type="text" class="form-control" name="cellulare" value=<?php echo ("'$cellulare'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label class="form-label text-nowrap">Indirizzo Email</label>
                                        <input maxlength="50" type="text" class="form-control" name="email" value=<?php echo ("'$email'") ?>>
                                    </div>

                                </div>

                            </div>
                            <!-- card body end -->
                        </div>
                        <!-- card dati anagrafica end -->


                        <!-- Card dati fiscali start -->
                        <div class="card mb-4">


                            <div class="card-header">
                                <h5>Dati fiscali del paziente o di chi ne fa le veci</h5>
                            </div>

                            <div class="card-body">



                                <div class="row">

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Nome</label>
                                        <input maxlength="15" type="text" class="form-control" name="pnome" required="true" value=<?php echo ("'$pnome'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Cognome</label>
                                        <input maxlength="20" type="text" class="form-control" name="pcognome" required="true" value=<?php echo ("'$pcognome'") ?>>
                                    </div>


                                    <div class=" col-sm-12 col-md-4 mb-3">

                                        <label class="form-label">Sesso</label>

                                        <select class="form-control" name="psesso" required="true">
                                            <option <?php if (!isset($_GET['id'])) echo ("selected='selected'"); ?> value="">-Seleziona-</option>
                                            <option <?php if (isset($_GET['id']) && $psesso == "M") echo ("selected='selected'"); ?> value="M">Maschio</option>
                                            <option <?php if (isset($_GET['id']) && $psesso == "F") echo ("selected='selected'"); ?> value="F">Femmina</option>
                                        </select>

                                    </div>
                                    <!-- container M-F end -->

                                </div>

                                <div class="row">


                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Nato/a a</label>
                                        <input maxlength="20" type="text" class="form-control" placeholder="Città" name="pcittaNascita" required="true" value=<?php echo ("'$pcittaNascita'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Provincia</label>
                                        <select class="form-control" name="pprovinciaNascita" required="true">
                                            <!-- SELECTED SELEZIONA SE E' AGGIUNZI PAZIENTE, ALTRIMENTI LA PROVINCIA -->
                                            <option <?php if (!isset($_GET['id'])) echo ("selected='selected'"); ?> value="">-Seleziona-</option>
                                            <?php
                                            for ($i = 0; $i < count($option); $i = $i + 2) {
                                                if (isset($_GET["id"]) && $pprovinciaNascita == $option[$i]) {
                                                    echo ("<option value='$option[$i]' selected='selected'>" . $option[$i + 1] . "</option>");
                                                } else {
                                                    echo ("<option value='$option[$i]'>" . $option[$i + 1] . "</option>");
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Data di nascita</label>
                                        <input type="date" class="form-control" placeholder="gg/mm/aaaa" name="pdataNascita" required="true" value=<?php echo ("'$pdataNascita'") ?>>
                                    </div>



                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Residente in</label>
                                        <input maxlength="45" type="text" class="form-control" placeholder="Comune" name="presidenza" required="true" value=<?php echo ("'$presidenza'") ?>>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">Provincia</label>
                                        <select class="form-control" name="pprovincia" required="true">
                                            <!-- SELECTED SELEZIONA SE E' AGGIUNZI PAZIENTE, ALTRIMENTI LA PROVINCIA -->
                                            <option <?php if (!isset($_GET['id'])) echo ("selected='selected'"); ?> value="">-Seleziona-</option>
                                            <?php
                                            for ($i = 0; $i < count($option); $i = $i + 2) {
                                                if (isset($_GET["id"]) && $pprovincia == $option[$i]) {
                                                    echo ("<option value='$option[$i]' selected='selected'>" . $option[$i + 1] . "</option>");
                                                } else {
                                                    echo ("<option value='$option[$i]'>" . $option[$i + 1] . "</option>");
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label">CAP</label>
                                        <input type="text" class="form-control" maxlength="5" name="pcap" required="true" value=<?php echo ("'$pcap'") ?>>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Prestazioni per</label>
                                        <input maxlength="35" type="text" class="form-control" name="pprestazioni" value=<?php echo ("'$pprestazioni'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3">
                                        <label class="form-label text-nowrap">Codice Fiscale</label>
                                        <input maxlength="16" type="text" class="form-control" name="pcf" required="true" value=<?php echo ("'$pcf'") ?>>
                                    </div>

                                    <div class="col-sm-12 col-md-4 mb-3 align-self-end">
                                        <span class="btn btn-secondary" onclick="calcolaCf()">Calcola CF</span>
                                    </div>

                                </div>

                            </div>
                            <!-- body card dati fiscali end -->
                        </div>
                        <!-- card dati fiscali end -->

                        <!-- Bottone modifica se si sta modificando un paziente, altrimenti aggiungi -->
                        <?php if (isset($_GET["id"])) { ?>
                            <div class="pb-4">
                                <button class="btn btn-primary btn-block" type="submit" name="modificaPaziente">Modifica</button>
                            </div>
                        <?php } ?>

                        <?php if (!isset($_GET["id"])) { ?>
                            <div class="pb-4">
                                <button class="btn btn-primary btn-block" type="submit" name="aggiungiPaziente">Aggiungi paziente</button>
                            </div>
                        <?php } ?>

                </form>
                <!-- form dati pagante end -->
            </div>
            <!-- contenitore carte fluid end -->

        </div>
        <!-- end main page -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Including LogoutModal -->
    <?php require __DIR__ . "/../modals/logoutModal.html" ?>

    <?php require __DIR__  . "/../footer.html" ?>

</body>

</html>

<!-- Script per il calcolo del codice fiscale -->
<script>
    function calcolaCf() {

        var date = document.getElementsByName("pdataNascita")[0].value;

        //Esempio di data: 2021-05-30
        var year = date.substring(0, 4);
        var month = date.substring(5, 7);
        var day = date.substring(8);


        var cf = new CodiceFiscale({
            name: document.getElementsByName("pnome")[0].value,
            surname: document.getElementsByName("pcognome")[0].value,
            gender: document.getElementsByName("psesso")[0].value,
            day: day,
            month: month,
            year: year,
            birthplace: document.getElementsByName("pcittaNascita")[0].value,
            birthplaceProvincia: document.getElementsByName("pprovinciaNascita")[0].value // Optional
        });

        document.getElementsByName("pcf")[0].value = cf.code;

    }
</script>