<?php
include("connexion.inc.php");
include("header.html");


$results=$conn->query("SELECT nom, prenom, id_comite, nom_comite, id_auteur FROM est_membre NATURAL JOIN comite NATURAL JOIN auteur ORDER BY id_comite;");
$results->setFetchMode(PDO::FETCH_ASSOC);
$tmp = '';
?>
<div>
<?php foreach($results as $ligne):
    if ($tmp != $ligne['id_comite']){
        $tmp= $ligne['id_comite'];
        echo '<br><p class="comite">'.$ligne['nom_comite'].'</p>';
        
    }?>
    <div class="membre"><a href="result_auteur.php?id_auteur=<?= $ligne['id_auteur']?>"><?=$ligne['nom'].' '.$ligne['prenom'].'<br>'?></a></div>
<?php endforeach; ?>
    </div>
<?php include("footer.html"); ?>