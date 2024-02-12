<?php
  session_start();
  session_destroy();
  header("Location: /presentation/pages/login.php");
?>