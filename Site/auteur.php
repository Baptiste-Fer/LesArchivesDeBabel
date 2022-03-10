<?php
include("connexion.inc.php");
include("header.html");

$results=$conn->query("SELECT * FROM auteur;");
$results->setFetchMode(PDO::FETCH_ASSOC);
?>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Téléphone</th>
            <th>Site personnel</th>
        </tr>
    </thead>
    <tbody>
            <?php foreach($results as $ligne): ?>
        <tr>
        <td><a href="result_auteur.php?id_auteur=<?= $ligne['id_auteur']?>"><?= $ligne['prenom'] ?></a></td>
        <td><a href="result_auteur.php?id_auteur=<?= $ligne['id_auteur']?>"><?= $ligne['nom'] ?></a></td>
        <td><?= $ligne['mail'] ?></td>
        <td><?= $ligne['tel'] ?></td>
        <td><a href="<?= $ligne['site_perso'] ?>"><?= $ligne['site_perso'] ?></a></td>
        </tr>
    <?php endforeach ?>
        </tr>
    </tbody>
</table>



<?php include("footer.html"); ?>