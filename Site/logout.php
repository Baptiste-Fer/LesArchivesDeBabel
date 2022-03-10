<?php
 session_start();

  echo "Déconnexion réussie !";
  session_destroy();
  header("Location: login.php");
?>
