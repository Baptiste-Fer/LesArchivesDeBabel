<?php
include("connexion.inc.php");
include("header.html");
include("footer.html");

$results=$conn->query("SELECT * FROM revue;");
$results->setFetchMode(PDO::FETCH_ASSOC);
?>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>
            <?php foreach($results as $ligne):?>
        <tr>
        <td><?= $ligne['nom_revue']?></td>
        <td><a href="https://<?= $ligne['url_revue']?>"><?= $ligne['url_revue']?></a></td>
        </tr>
    <?php endforeach;?>
        </tr>
    </tbody>
</table>