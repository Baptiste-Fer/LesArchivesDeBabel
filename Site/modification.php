<?php
session_start();
include("connexion.inc.php");
include('header.html');

if(!isset($_SESSION['use'])){
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
}
else{
    if (isset($_GET['id_auteur'])){
        $res = $conn->prepare('SELECT * FROM auteur WHERE id_auteur = ?');
        $res->execute(array($_GET['id_auteur']));
        $auteur = $res->fetch();
        ?>

        <html>
            <h1>Modifier auteur</h1>
            <form action='modifier.php' method="POST">
                <p>
                    <input type="hidden" id="id" name="id" value="<?= $auteur['id_auteur'] ?>">
                </p>
                <p>
                    <label for="site">Site Personnel</label>
                    <input type="text" id="site" name="site" value="<?= $auteur['site_perso'] ?>">
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }

    //ARTICLES
    elseif (isset($_GET['ref_article'])){
        $res = $conn->prepare('SELECT * FROM articles WHERE ref_article = ?');
        $res->execute(array($_GET['ref_article']));
        $article = $res->fetch();
        ?>

        <html>
            <h1>Modifier articles</h1>
            <form action='modifier.php' method="POST">
                <p>
                    <input type="hidden" id="ref_article" name="ref_article" value="<?= $article['ref_article'] ?>">
                </p>
                <p>
                    <label for="titre">Titre</label>
                    <input type="text" id="titre" name="titre" value="<?= $article['titre'] ?>">
                </p>
                <p>
                    <label for="nb_pages">Nombre de pages</label>
                    <input type="text" id="nb_pages" name="nb_pages" value="<?= $article['nb_pages'] ?>">
                </p>
                <p>
                    <label for="annee">Année de publication</label>
                    <input type="text" id="annee" name="annee" value="<?= $article['annee'] ?>">
                </p>
                <p>
                    <label for="url">Lien</label>
                    <input type="text" id="url" name="url" value="<?= $article['url_article'] ?>">
                </p>
                <p>
                    <label for="langue">Langue</label>
                    <input type="text" id="langue" name="langue" value="<?= $article['id_langue'] ?>">
                </p>
                <p>
                    <label for="ref_revue">Référence de la revue</label>
                    <input type="text" id="ref_revue" name="ref_revue" value="<?= $article['ref_revue'] ?>">
                </p>
                <p>
                    <label for="numero">Numéro</label>
                    <input type="text" id="numero" name="numero" value="<?= $article['numero'] ?>">
                </p>
                <p>
                    <label for="volume">Volume</label>
                    <input type="text" id="volume" name="volume" value="<?= $article['volume'] ?>">
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
    //COMITE
    elseif (isset($_GET['id_comite'])){
        $res = $conn->prepare('SELECT * FROM comite WHERE id_comite = ?');
        $res->execute(array($_GET['id_comite']));
        $comite = $res->fetch();
        ?>

        <html>
            <h1>Modifier comités</h1>
            <form action='modifier.php' method="POST">
                <p>
                    <input type="hidden" id="id_comite" name="id_comite" value="<?= $comite['id_comite'] ?>">
                </p>
                <p>
                    <label for="nom_comite">Nom</label>
                    <input type="text" id="nom_comite" name="nom_comite" value="<?= $comite['nom_comite'] ?>">
                </p>
                <p>
                    <label for="nb_membre">Nombre de membres</label>
                    <input type="text" id="nb_membre" name="nb_membre" value="<?= $comite['nb_membre'] ?>">
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
    //REVUES
    elseif (isset($_GET['ref_revue'])){
        $res = $conn->prepare('SELECT * FROM revue WHERE ref_revue = ?');
        $res->execute(array($_GET['ref_revue']));
        $revue = $res->fetch();
        ?>

        <html>
            <h1>Modifier revues</h1>
            <form action='modifier.php' method="POST">
                <p>
                    <input type="hidden" id="ref_revue" name="ref_revue" value="<?= $revue['ref_revue'] ?>">
                </p>
                <p>
                    <label for="nom_revue">Nom</label>
                    <input type="text" id="nom_revue" name="nom_revue" value="<?= $revue['nom_revue'] ?>">
                </p>
                <p>
                    <label for="url_revue">Lien</label>
                    <input type="text" id="url_revue" name="url_revue" value="<?= $revue['url_revue'] ?>">
                </p>
                <p>
                    <label for="id_comite">Identifiant comité</label>
                    <input type="text" id="id_comite" name="id_comite" value="<?= $revue['id_comite'] ?>">
                </p>
                <p>
                    <input type="submit" value="Enregistrer">
                </p>
            </form>
        </html>
        <?php
    }
} ?>