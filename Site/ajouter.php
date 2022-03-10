<?php
session_start();
include("connexion.inc.php");
include('header.html');

if(!isset($_SESSION['use'])){
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
}
else{
    if(isset($_POST['id_auteur'])){
        $res = $conn->prepare('INSERT INTO auteur VALUES(?, ?, ?, ?, ?, ?)');
        $exec_ok = $res->execute(array($_POST['id_auteur'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['site_perso']));
    }
    elseif(isset($_POST['ref_article'])){
        $res = $conn->prepare('INSERT INTO articles VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $exec_ok = $res->execute(array($_POST['ref_article'], $_POST['titre'], $_POST['nb_pages'],
                                       $_POST['annee'], $_POST['url_article'],$_POST['id_langue'],
                                       $_POST['ref_revue_a'], $_POST['numero'], $_POST['volume']));
    }
    elseif(isset($_POST['id_comite'])){
        $res = $conn->prepare('INSERT INTO comite VALUES(?, ?, ?)');
        $exec_ok = $res->execute(array($_POST['id_comite'], $_POST['nom_comite'], $_POST['nb_membre']));
    }
    elseif(isset($_POST['ref_revue'])){
        $res = $conn->prepare('INSERT INTO revue VALUES(?, ?, ?, ?)');
        $exec_ok = $res->execute(array($_POST['ref_revue'], $_POST['nom_revue'], $_POST['url_revue'], $_POST['id_comite_r']));
    }





    if($exec_ok) echo 'Ajout réussi !';
    else echo "Echec de l'ajout !";
}
?>