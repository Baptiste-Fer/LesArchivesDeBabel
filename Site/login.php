<?php
session_start();
include("connexion.inc.php");
include("header.html");

$results=$conn->query("SELECT * FROM administrateur;");
$results->setFetchMode(PDO::FETCH_ASSOC);

if(isset($_SESSION['use'])){
    header("Location:page_login.php");
}

if(isset($_POST['user'])){
    $admin = $_POST['user'];
    $mdp = $_POST['pass'];

    foreach($results as $ligne){
        if($admin == $ligne['identifiant'] && $mdp == $ligne['mdp']){
            $_SESSION['use']=$admin;
            header("Location:index.php");
        }
        echo "Identifiant ou mot de passe incorrect.";
    }
}
?>
<html>
    <form action="" method="POST">
    <table>
    <tr>
        <td>  Identifiant</td>
        <td> <input type="text" name="user" > </td>
    </tr>
    <tr>
        <td> Mot de passe  </td>
        <td><input type="password" name="pass"></td>
    </tr>
    <tr>
        <td> <input type="submit" name="login" value="LOGIN"></td>
        <td> <input type="reset" name="reset" value="Effacer" /> </td>
    </tr>
    </table>
    </form>
</html>
<?php include("footer.html");?>