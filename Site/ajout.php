<?php
session_start();
include("connexion.inc.php");
include('header.html');

if(!isset($_SESSION['use'])){
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
}
else{
    $table = $_GET['table'];
    if($table=='auteurs'){ ?>
        <html>
            <h1>Ajouter auteur</h1>
            <form action='ajouter.php' method="POST">
                <p>
                    <label for="id_auteur">Identifiant</label>
                    <input type="text" id="id_auteur" name="id_auteur">
                </p>
                <p>
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom">
                </p>
                <p>
                    <label for="prennom">Prenom</label>
                    <input type="text" id="prenom" name="prenom">
                </p>
                <p>
                    <label for="mail">Mail</label>
                    <input type="text" id="mail" name="mail">
                </p>
                <p>
                    <label for="tel">Téléphone</label>
                    <input type="text" id="tel" name="tel">
                </p>
                <p>
                    <label for="site_perso">Site Personnel</label>
                    <input type="text" id="site_perso" name="site_perso">
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
    elseif($table=='articles'){ ?>
        <html>
            <h1>Ajouter article</h1>
            <form action='ajouter.php' method="POST">
                <p>
                    <label for="ref_article">Rérérence</label>
                    <input type="text" id="ref_article" name="ref_article">
                </p>
                <p>
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre">
                </p>
                <p>
                    <label for="nb_pages">Nombre de pages</label>
                    <input type="number" id="nb_pages" name="nb_pages">
                </p>
                <p>
                    <label for="annee">Année de publication</label>
                    <input type="number" id="annee" name="annee">
                </p>
                <p>
                    <label for="url_article">Lien</label>
                    <input type="text" id="url_article" name="url_article">
                </p>
                <p>
                    <label for="id_langue">Langue(identifiant)</label>
                    <input type="text" id="id_langue" name="id_langue">
                </p>
                <p>
                    <label for="ref_revue_a">Référence revue</label>
                    <input type="text" id="ref_revue_a" name="ref_revue_a">
                </p>
                <p>
                    <label for="numero">Numéro</label>
                    <input type="number" id="numero" name="numero" value=-1>
                </p>
                <p>
                    <label for="volume">Volume</label>
                    <input type="number" id="volume" name="volume" value=-1>
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
    elseif($table=='comites'){ ?>
        <html>
            <h1>Ajouter comité</h1>
            <form action='ajouter.php' method="POST">
                <p>
                    <label for="id_comite">Identifiant</label>
                    <input type="text" id="id_comite" name="id_comite">
                </p>
                <p>
                    <label for="nom_comite">Nom du comité</label>
                    <input type="text" id="nom_comite" name="nom_comite">
                </p>
                <p>
                    <label for="nb_membre">Nombre de membres</label>
                    <input type="number" id="nb_membre" name="nb_membre" value=0> 
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
    elseif($table=='revues'){ ?>
        <html>
            <h1>Ajouter revue</h1>
            <form action='ajouter.php' method="POST">
                <p>
                    <label for="ref_revue">Identifiant</label>
                    <input type="text" id="ref_revue" name="ref_revue">
                </p>
                <p>
                    <label for="nom_revue">Nom de la revue</label>
                    <input type="text" id="nom_revue" name="nom_revue">
                </p>
                <p>
                    <label for="url_revue">Lien</label>
                    <input type="text" id="url_revue" name="url_revue"> 
                </p>
                <p>
                    <label for="id_comite_r">Identifiant comité</label>
                    <input type="text" id="id_comite_r" name="id_comite_r"> 
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
}
?>