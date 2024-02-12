<!DOCTYPE html>
<html lang="it">

<head>


  <?php
  require "./includes/checkLogin.php";
  require_once "./includes/header.html";

  /* Get utenti del sistema */
  require_once "./DAO/UserDAO.php";
  $users = $userDAO->getUsers();

  ?>

  <title>Dcare: Impostazioni</title>


</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Including Sidebar -->
    <?php require "./presentation/sidebar.html" ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Including Topbar -->
      <?php require "./presentation/topbar.php" ?>


      <!-- begin main page -->
      <div class="d-flex align-items-center justify-content-center h-100">

        <!-- Lista utenti -->
        <div class="card p-2 pb-0 " style="height: 50%; width: 25%;">

          <div class="card-body px-1 h-100">
            <h5 class="card-title">Lista utenti</h5>

            <div class="col overflow-auto" style="height: 95%; overflow-x: hidden !important;">

              <?php foreach ($users as $u) : ?>

                <div class="row row-hover row-hover border-bottom py-3">
                  <?php echo $u["nickname"]; ?>
                </div>

              <?php endforeach ?>

              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>
              <div class="row row-hover row-hover border-bottom py-3">
                utente
              </div>


            </div>

          </div>

        </div>
        <!-- End lista utenti -->

        <div class="card ml-3" style="height: 50%; width: 30%;">

          <div class="card-body">
            <h5 class="card-title">NICKNAME</h5>

            <div class="col">
              <div class="row">prova</div>
            </div>

          </div>

          <div class="card-footer bg-white">
            <div class="row flex-row-reverse no-gutters">
              <div class="btn btn-primary ml-2">Modifica</div>
              <div class="btn btn-danger">Elimina Utente</div>
            </div>
          </div>

        </div>

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
  <?php require "./includes/logoutModal.html" ?>

  <?php require "./includes/footer.html" ?>

</body>

</html>