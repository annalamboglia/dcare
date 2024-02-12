<!DOCTYPE html>
<html lang="it">

<head>

  <?php
  require "./business_logic/permissionManager.php";
  require_once "./presentation/header.html";
  ?>


  <title>Dcare</title>


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
      <div class="container-fluid mx-3">

        <div class="row align-items-center" style="height: 80vh;">
          <div class="col">

            <div class="row no-gutters justify-content-center">
              <div class="fa fa-tooth text-primary" style="font-size: 20rem;"></div>
            </div>

            <div class="row no-gutters justify-content-center mt-4">
              <span class="h1">Benvenuto!</span>
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
  <?php require "./presentation/modals/logoutModal.html" ?>

  <?php require "./presentation/footer.html" ?>

</body>

</html>