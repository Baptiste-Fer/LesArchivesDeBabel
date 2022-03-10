<?php session_start();

if(!isset($_SESSION['use'])){
    header("Location:login.php");
}
echo $_SESSION['use'];
echo "Connexion réussi !";
echo "<a href='logout.php'>Déconnexion</a>";
?>