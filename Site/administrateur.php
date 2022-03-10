<?php
session_start();
include("connexion.inc.php");
include("header.html");

if(!isset($_SESSION['use'])){
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
}
else{
    ?>
    <html>
        <div class="page_admin">
            <h1>Que voulez vous modifier ?</h1>
            <form action="modif.php" method="POST">
                <p>
                    <label for="type">Type : </label><br>
                    <select name="type" id="type">
                        <option value="auteurs">Auteurs</option>
                        <option value="articles">Articles</option>
                        <option value="comites">Comités</option>
                        <option value="revues">Revues</option>
                    </select>
                </p>
                <p>
                    <label for="action">Action : </label><br>
                    <select name="action" id="action">
                        <option value="ajouter">Ajouter</option>
                        <option value="modifier">Modifier</option>
                        <option value="supprimer">Supprimer</option>
                    </select>
                </p>
                <input type="submit" value="Valider" />
            </form>

        </div>
    </html>
    <?php
}

include("footer.html");
?>