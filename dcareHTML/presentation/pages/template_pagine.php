<!DOCTYPE html>
<html lang="it">

<head>


  <?php
    require "./includes/checkLogin.php";
    require_once "./includes/header.html";
  ?>


  <title>TITOLO PAGINA</title>


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

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
          commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
          nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
          id est laborum.</p>

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