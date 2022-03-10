<?php
include("connexion.inc.php");
include("header.html");

$ref_article = $_GET['ref_article'];
$res = $conn->query("SELECT titre FROM articles WHERE ref_article='".$ref_article."';");
$res->setFetchMode(PDO::FETCH_ASSOC);

?>
<?php foreach($res as $ligne):?>
        <h1><?= $ligne['titre'] ?></h1>
<?php endforeach; ?>

<h3>Auteur(s)</h3>

<?php 
$res = $conn->query("SELECT id_auteur, nom, prenom FROM articles NATURAL JOIN ecrit NATURAL JOIN auteur NATURAL JOIN langues WHERE ref_article='".$ref_article."';");
$res->setFetchMode(PDO::FETCH_ASSOC); ?>
<?php foreach($res as $ligne):?>
    <a href="result_auteur.php?id_auteur=<?=$ligne['id_auteur']?>">
        <?= $ligne['nom'].' '.$ligne['prenom']."<br>" ?>
    </a>
<?php endforeach;?>

<?php $cmpt=0;
$res = $conn->query("SELECT * FROM articles NATURAL JOIN ecrit NATURAL JOIN auteur NATURAL JOIN langues WHERE ref_article='".$ref_article."';");
$res->setFetchMode(PDO::FETCH_ASSOC);
?>
<?php foreach($res as $ligne):?>
    <?php if($cmpt==0):?>
    <h3>Informations sur cet articles</h3>
    <ul>
        <li>Numéro : <?= $ligne['numero'] ?></li>
        <li>Volume : <?= $ligne['volume'] ?></li>
        <li>Année de publication : <?= $ligne['annee'] ?></li>
        <li>Nombre de pages : <?= $ligne['nb_pages'] ?></li>
        <li>Référence revue : <?= $ligne['ref_revue'] ?></li>
        <li>Langue : <?= $ligne['nom_langue'] ?></li>
        <li>Lien : 
            <a href="<?= $ligne['url_article']?>">
                <?= $ligne['url_article'] ?>
            </a>
        </li>
    </ul>
    
    <?php $cmpt++; endif ?>

<?php endforeach ?>

<?php include("footer.html") ?>



