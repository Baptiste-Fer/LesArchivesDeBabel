<?php
include("connexion.inc.php");
include("header.html");

$id_auteur = $_GET['id_auteur'];
$res = $conn->query("SELECT nom, prenom FROM auteur WHERE id_auteur='".$id_auteur."';");
$res->setFetchMode(PDO::FETCH_ASSOC);

foreach($res as $ligne):?>
    <h1><?= $ligne['nom'].' '.$ligne['prenom'] ?></h1>
    <h3>Informations sur l'auteur</h3>
<?php endforeach;
$res = $conn->query("SELECT DISTINCT * FROM auteur WHERE id_auteur='".$id_auteur."';");
$res->setFetchMode(PDO::FETCH_ASSOC);
foreach ($res as $ligne):?>
    <ul>
        <li>Mail : <?= $ligne['mail'] ?></li>
        <li>Téléphone : <?= $ligne['tel'] ?></li> 
        <li>Site personnel : 
            <a href="<?= $ligne['site_perso']?>">
                <?= $ligne['site_perso'] ?>
            </a>
        </li>
    </ul>
<?php endforeach ?>

<h3>Article(s) écrit :</h3>
<?php
$res = $conn->query("SELECT DISTINCT titre, annee, ref_article FROM auteur NATURAL JOIN ecrit NATURAL JOIN articles WHERE id_auteur='".$id_auteur."' ORDER BY annee;");
$res->setFetchMode(PDO::FETCH_ASSOC);
foreach ($res as $ligne):?>
    <ul>
            <li><a href="result_article.php?ref_article=<?= $ligne['ref_article']?>"><?= $ligne['titre']?></a>(<?=$ligne['annee']?>)
            </li>
        </ul>
<?php endforeach ?>


    
<?php include("footer.html") ?>