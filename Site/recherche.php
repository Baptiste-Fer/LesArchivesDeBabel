<?php
include("connexion.inc.php");
include("header.html");

$id_auteur = $_POST['auteur'];
$id_domaine = $_POST['domaine'];
$id_langue = $_POST['langue'];
$annee = $_POST['annee'];
$ref_revue = $_POST['revue'];
$id_labo = $_POST['labo'];

if(!($_POST['rech']!='')){

    $req1 = "SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM ecrit NATURAL JOIN articles NATURAL JOIN langues WHERE id_auteur='$id_auteur';";
    $req2 = "SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM domaines NATURAL JOIN appartient NATURAL JOIN articles NATURAL JOIN langues WHERE id_domaine='$id_domaine';";
    $req3 = "SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN langues WHERE id_langue='$id_langue';";
    $req4 = "SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN langues WHERE annee = $annee;";
    $req5 = "SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN langues WHERE ref_revue='$ref_revue';";
    $req6 = "SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM ecrit NATURAL JOIN articles NATURAL JOIN langues WHERE id_labo='$id_labo';";

    $concat = 'INTERSECT';
    $est_premier = true;

    $req = '';
    if($id_auteur!='tous') $req = $req.$req1;

    if($id_domaine!='tous'){
        if($est_premier){
            $req = $req.$req2;
            $est_premier = false;
        }
        else $req = $req.$concat.$req2;
    }
    if($id_langue!='tous'){
        if($est_premier){
            $req = $req.$req3;
            $est_premier = false;
        }
        else $req = $req.$concat.$req3;

    }
    if($annee!='tous'){
        if($est_premier){
            $req = $req.$req4;
            $est_premier = false;
        }
        else $req = $req.$concat.$req4;
    }
    if($ref_revue!='tous'){
        if($est_premier){
            $req = $req.$req5;
            $est_premier = false;
        }
        else $req = $req.$concat.$req5;
    }
    if($id_labo!='tous'){
        if($est_premier){
            $req = $req.$req6;
            $est_premier = false;
        }
        else $req = $req.$concat.$req6;
    }
    if($id_auteur=='tous' && $id_domaine=='tous' && $id_langue=='tous' && $annee=='tous' && $ref_revue=='tous' && $id_labo=='tous')
        $req='SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN langues;';
}
else{
    $rech = $_POST['rech'];
    $req1="SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN langues WHERE titre LIKE '%$rech%' OR nom_langue LIKE '%$rech%' OR url_article LIKE '%$rech%' ";
    $req2="SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM domaines NATURAL JOIN articles NATURAL JOIN appartient NATURAL JOIN langues WHERE nom_domaine LIKE '%$rech%' ";
    $req3="SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM langues NATURAL JOIN articles WHERE nom_langue LIKE '%$rech%' ";
    $req4="SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN revue NATURAL JOIN langues WHERE nom_revue LIKE '%$rech%' ";
    $req5="SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN ecrit NATURAL JOIN auteur NATURAL JOIN langues WHERE nom LIKE '%$rech%' OR prenom LIKE '%$rech%' ";
    $req6="SELECT ref_article, titre, numero, volume, annee, nb_pages, ref_revue, nom_langue, url_article FROM articles NATURAL JOIN ecrit NATURAL JOIN laboratoires NATURAL JOIN langues WHERE nom_labo LIKE '%$rech%' ";

    $union='UNION ';
    $req = $req1.$union.$req2.$union.$req3.$union.$req4.$union.$req5.$union.$req6.';';
}


//echo"$req";
$results=$conn->query($req);
$results->setFetchMode(PDO::FETCH_ASSOC);

if ($results->rowCount()==0):
    echo 'Aucun articles correspondant à votre recherche.';
else:?>
        <table>
        <thead>
        <tr>
        <th>Titre</th>
        <th>Numéro</th>
        <th>Volume</th>
        <th>Année du publication</th>
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
                <td><?= $ligne['numero']?></td>
                <td><?= $ligne['volume']?></td>
                <td><?= $ligne['annee']?></td>
                <td><?= $ligne['nb_pages']?></td>
                <td><?= $ligne['ref_revue']?></td>
                <td><?= $ligne['nom_langue']?></td>
                <td><?= $ligne['url_article']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        </table>
<?php endif;?>
<?php
include("footer.html");
?>