<?php
  require_once __DIR__ . "/../data_access/dao/UserDAO.php";
  $user = $userDAO->getUserById($_SESSION["id"]);
  $nomeUtente = $user["nickname"]
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Topbar Navbar Items List  -->
    <!-- Gli elementi della top-bar sono nascosti per eventuali impementazioni future -->
    <ul class="navbar-nav ml-auto">


      <!-- Nav Item - Notifiche -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle d-none" href="#" id="notificheDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>

          <!-- Counter - Notifiche -->
          <span class="badge badge-danger badge-counter">3+</span>
        </a>


        <!-- Dropdown - Notifiche -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
          aria-labelledby="notificheDropdown">

          <h6 class="dropdown-header">
            Notifiche
          </h6>

          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 12, 2019</div>
              <span class="font-weight-bold">A new monthly report is ready to download!</span>
            </div>
          </a>

          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-success">
                <i class="fas fa-donate text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 7, 2019</div>
              $290.29 has been deposited into your account!
            </div>
          </a>

          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-warning">
                <i class="fas fa-exclamation-triangle text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 2, 2019</div>
              Spending Alert: We've noticed unusually high spending for your account.
            </div>
          </a>

          <a class="dropdown-item text-center small text-gray-500" href="#">Mostra notifiche</a>
          
        </div>

      </li> <!-- Nav Item end - Notifiche -->


      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">

        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo($nomeUtente); ?></span>
          <img class="img-profile rounded-circle" src="/img/undraw_profile.svg">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

          <a class="dropdown-item d-none" href="#">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profilo
          </a>

          <a class="dropdown-item d-none" href="impostazioni.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Impostazioni
          </a>

          <!-- <div class="dropdown-divider"></div> -->

          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>

        </div>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->