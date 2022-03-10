<?php
include("connexion.inc.php");
include("header.html");



$results_auteur=$conn->query("SELECT id_auteur, nom, prenom FROM auteur;");
$results_auteur->setFetchMode(PDO::FETCH_ASSOC);

$results_domaine=$conn->query("SELECT * FROM domaines;");
$results_domaine->setFetchMode(PDO::FETCH_ASSOC);

$results_langue=$conn->query("SELECT * FROM langues;");
$results_langue->setFetchMode(PDO::FETCH_ASSOC);

$results_annee=$conn->query("SELECT ref_article, annee FROM articles;");
$results_annee->setFetchMode(PDO::FETCH_ASSOC);

$results_revue=$conn->query("SELECT ref_revue, nom_revue FROM revue;");
$results_revue->setFetchMode(PDO::FETCH_ASSOC);

$results_laboratoire=$conn->query("SELECT id_labo, nom_labo FROM laboratoires;");
$results_laboratoire->setFetchMode(PDO::FETCH_ASSOC);

?>
<html>
    <form method="post" action="recherche.php" class="recherche">
        <p>
                <label for="rech">Recherche : </label><br>
                <input type="text" name="rech" id="rech">
                
        </p>
        <p>OU</p>
        <p>
            <label for="auteur">Auteur : </label><br>
            <select name="auteur" id="auteur">
                <option value="tous">Tous</option>';
                <?php
                foreach($results_auteur as $ligne){
                    echo'
                    <option value="'.$ligne["id_auteur"].'">'.$ligne["nom"].' '.$ligne["prenom"].'</option>';
                }?>
            </select>
        </p>
        <p>
            <label for="domaine">Domaine : </label><br>
            <select name="domaine" id="domaine">
                <option value="tous">Tous</option>
                <?php
                foreach($results_domaine as $ligne){
                    echo'
                    <option value="'.$ligne["id_domaine"].'">'.$ligne["nom_domaine"].'</option>';
                }?>
            </select>
        </p>
        <p>
            <label for="langue">Langue : </label><br>
            <select name="langue" id="langue">
                <option value="tous">Toutes</option>
                <?php
                foreach($results_langue as $ligne){
                    echo'
                    <option value="'.$ligne["id_langue"].'">'.$ligne["nom_langue"].'</option>';
                }?>
            </select>
        </p>
        <p>
            <label for="annee">Année de publication : </label><br>
            <select name="annee" id="annee">
                <option value="tous">Toutes</option>
                <?php
                foreach($results_annee as $ligne){
                    echo'
                    <option value="'.$ligne["annee"].'">'.$ligne["annee"].'</option>';
                }?>
            </select>
        </p>
        <p>
            <label for="revue">Revue : </label><br>
            <select name="revue" id="revue">
                <option value="tous">Toutes</option>
                <?php
                foreach($results_revue as $ligne){
                    echo'
                    <option value="'.$ligne["ref_revue"].'">'.$ligne["nom_revue"].'</option>';
                }?>
            </select>
        </p>
        <p>
            <label for="labo">Laboratoire : </label><br>
            <select name="labo" id="labo">
                <option value="tous">Tous</option>
                <?php
                foreach($results_laboratoire as $ligne){
                    echo'
                    <option value="'.$ligne["id_labo"].'">'.$ligne["nom_labo"].'</option>';
                }?>
            </select>
        </p>
        <p>
            <input type="submit" value="Rechercher" /><br><br><br><br>
        </p>
    </form>
</html>


<?php include("footer.html"); ?>