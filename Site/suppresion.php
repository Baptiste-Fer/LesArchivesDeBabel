<?php 
session_start();
include("connexion.inc.php");
include('header.html');

if(!isset($_SESSION['use'])){
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
}
else{
    if (isset($_GET['id_auteur'])){
        $res = $conn->prepare('DELETE FROM auteur WHERE id_auteur = ?');
        $exec_ok = $res->execute(array($_GET['id_auteur']));
    }
    if (isset($_GET['ref_article'])){
        $res = $conn->prepare('DELETE FROM articles WHERE ref_article = ?');
        $exec_ok = $res->execute(array($_GET['ref_article']));

    }
    if (isset($_GET['id_comite'])){
        $res = $conn->prepare('DELETE FROM comite WHERE id_comite = ?');
        $exec_ok = $res->execute(array($_GET['id_comite']));
    }
    if (isset($_GET['ref_revue'])){
        $res = $conn->prepare('DELETE FROM revue WHERE ref_revue= ?');
        $exec_ok = $res->execute(array($_GET['ref_revue']));
    }
    

    if($exec_ok) echo "Suppresion réussi !";
    else echo "Echec de la suppression !";
}
?>