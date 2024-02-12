<?php

$allert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "../../data_access/DAO/UserDAO.php";

    /* Richiesta di accesso*/
    $user = $userDAO->getUserByNick($_POST["user"]);

    /* Utente trovato */
    if ($user) {

        /* Controllo password */
        if (md5($_POST["password"]) == $user["password"]) {
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $user["id"];
            $_SESSION["role"] = $user["role"]; 
            header("Location: /index.php");
        }
    }


    /* Login non andato a buon fine */
    $allert = true;
}
?>


<!DOCTYPE html>
<html lang="it" class="h-100">

<head>

    <?php require_once "../header.html"; ?>


    <title>Dcare: Login</title>


</head>

<body class="bg-gradient-while h-100">

    <div class="container d-flex align-items-center justify-content-center h-100">

        <div class="card o-hidden border-0 shadow-lg my-5" style="min-width: 50%;">

            <div class="card-body p-0">

                <!-- Nested Row within Card Body -->
                <div class="row">

                    <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                    <div class="col-lg-12">
                        <div class="p-5">


                            <div class="text-center">
                                <div class="row justify-content-center">
                                    <div class="fas fa-tooth fa-5x text-primary"></div>
                                    <div class="h1 align-self-center ml-2">Dcare</div>
                                </div>

                            </div>

                            <div class="text-center mt-4">
                                <h1 class="h4 text-gray-900 mb-4">Benvenuto!</h1>
                            </div>


                            <form class="user" action="login.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="user" placeholder="Inserire username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>

                                    <?php if ($allert) { ?>

                                        <div class="text-danger mt-2 ml-1 small">Utente o Password errati</div>

                                    <?php } ?>

                                </div>




                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center d-none">
                                <a class="small" href="forgot-password.html">Password dimenticata?</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>



    <?php require "../footer.html" ?>

</body>

</html>