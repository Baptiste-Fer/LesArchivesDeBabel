<?php
include("connexion.inc.php");
include("header.html");
include("footer.html");

$results=$conn->query("SELECT * FROM laboratoires;");
$results->setFetchMode(PDO::FETCH_ASSOC);

echo '<table>
<thead>
    <tr>
        <th>Nom</th>
        <th>Lieu</th>
        <th>Site</th>
        <th>Adresse</th>
        <th>ville</th>
        <th>pays</th>
    </tr>
</thead>
<tbody>';
        foreach($results as $ligne){
    echo '<tr>';
    echo '<td>'.$ligne['nom_labo'].'</td>';
    echo '<td>'.$ligne['lieu'].'</td>';
    echo '<td>'.$ligne['site_web'].'</td>';
    echo '<td>'.$ligne['adresse'].'</td>';
    echo '<td>'.$ligne['ville'].'</td>';
    echo '<td>'.$ligne['pays'].'</td>';
    echo '</tr>';
}
echo'
    </tr>
</tbody>
</table>';
?>