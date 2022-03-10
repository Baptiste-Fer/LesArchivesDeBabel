<?php
include("connexion.inc.php");
include("header.html");?>

<?php
$results=$conn->query("SELECT * FROM articles NATURAL JOIN langues");
$results->setFetchMode(PDO::FETCH_ASSOC);

?>
<table class="affiche">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Numéro</th>
            <th>Volume</th>
            <th>Année de publication</th>
            <th>Nombre de pages</th>
            <th>Référence revue</th>
            <th>Langue</th>
            <th>Lien</th>
        </tr>
    </thead>
<tbody>
    <?php foreach($results as $ligne):?>
    <tr>
        <td><a href="result_article.php?ref_article=<?= $ligne['ref_article']?>"><?= $ligne['titre'] ?></a></td>
        <td><?= $ligne['numero'] ?></td>
        <td><?= $ligne['volume'] ?></td>
        <td><?= $ligne['annee'] ?></td>
        <td><?= $ligne['nb_pages'] ?></td>
        <td><?= $ligne['ref_revue'] ?></td>
        <td><?= $ligne['nom_langue'] ?></td>
        <td><?= $ligne['url_article'] ?></td>
    </tr>
    <?php endforeach ?>
</tbody>
</table>

<?php include("footer.html");?>