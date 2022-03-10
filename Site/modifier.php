<?php
session_start();
include("connexion.inc.php");
include('header.html');

if(!isset($_SESSION['use']))
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
else{
    if(isset($_POST['id'])){
        $res = $conn->prepare('UPDATE auteur set site_perso=? WHERE id_auteur=?');
        $exec_ok = $res->execute(array($_POST['site'], $_POST['id']));
    }
    elseif(isset($_POST['ref_article']) && isset($_POST['titre'])){
        $res = $conn->prepare('UPDATE articles set ref_article=?, titre=?, nb_pages=?, annee=?, url_article=?, id_langue=?, ref_revue=?,
        numero=?, volume=? WHERE ref_article=?');
        $exec_ok = $res->execute(array($_POST['ref_article'], $_POST['titre'], $_POST['nb_pages'], $_POST['annee'], $_POST['url'],
        $_POST['langue'], $_POST['ref_revue'], $_POST['numero'], $_POST['volume'], $_POST['ref_article']));
    }
    elseif(isset($_POST['id_comite']) && isset($_POST['nom_comite'])){
        $res = $conn->prepare('UPDATE comite set id_comite=?, nom_comite=?, nb_membre=? WHERE id_comite=?');
        $exec_ok = $res->execute(array($_POST['id_comite'], $_POST['nom_comite'], $_POST['nb_membre'], $_POST['id_comite']));
    }
    elseif(isset($_POST['ref_revue']) && isset($_POST['nom_revue'])){
        $res = $conn->prepare('UPDATE revue set ref_revue=?, nom_revue=?, url_revue=? WHERE ref_revue=?');
        $exec_ok = $res->execute(array($_POST['ref_revue'], $_POST['nom_revue'], $_POST['url_revue'], $_POST['ref_revue']));
    }


    if($exec_ok) echo "Mise à jour réussi !";
    else echo "Echec de la mise à jour !";
}
?>