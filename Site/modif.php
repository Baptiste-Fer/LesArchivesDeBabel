<?php
session_start();
include("connexion.inc.php");
include("header.html");

if(!isset($_SESSION['use'])){
    echo "Vous n'êtes pas connecté ! Veuillez cliquer sur le cadenas en bas à droite de la page."; 
}
else{
    $type = $_POST['type'];
    $action = $_POST['action'];

    if($action=='supprimer' || $action=='modifier'){
        if($type=='auteurs'){

            $results=$conn->query("SELECT * FROM auteur;");
            $results->setFetchMode(PDO::FETCH_ASSOC);
            
            echo '<table>
            <thead>
            <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Site personnel</th>
            <th>Action</th>
            
            </tr>
            </thead>
            <tbody>';
            foreach($results as $ligne):?>
                <tr>
                    <td><?= $ligne['prenom'] ?></td>
                    <td><?= $ligne['nom']?></td>
                    <td><?= $ligne['mail']?></td>
                    <td><?= $ligne['site_perso']?></td>
                    <td><a href="modification.php?id_auteur=<?= $ligne['id_auteur']?>">✏️</a>
                    <a href="suppresion.php?id_auteur=<?= $ligne['id_auteur'] ?>">❌</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <?php
        }
        //ARTICLES
        if($type=='articles'){
            $results=$conn->query("SELECT * FROM articles;");
            $results->setFetchMode(PDO::FETCH_ASSOC);
            
            echo '<table>
            <thead>
            <tr>
            <th>Référence</th>
            <th>Titre</th>
            <th>Nombre de pages</th>
            <th>Année de publication</th>
            <th>Site WEB</th>
            <th>Langue</th>
            <th>Référence revue</th>
            <th>Numéro</th>
            <th>Volume</th>
            <th>Action</th>
            
            </tr>
            </thead>
            <tbody>';
            foreach($results as $ligne):?>
                <tr>
                    <td><?= $ligne['ref_article'] ?></td>
                    <td><?= $ligne['titre']?></td>
                    <td><?= $ligne['nb_pages']?></td>
                    <td><?= $ligne['annee']?></td>
                    <td><?= $ligne['url_article']?></td>
                    <td><?= $ligne['id_langue']?></td>
                    <td><?= $ligne['ref_revue']?></td>
                    <td><?= $ligne['numero']?></td>
                    <td><?= $ligne['volume']?></td>
                    <td><a href="modification.php?ref_article=<?= $ligne['ref_article']?>">✏️</a>
                    <a href="suppresion.php?ref_article=<?= $ligne['ref_article'] ?>">❌</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <?php
        }
        //COMITE
        if($type=='comites'){
            $results=$conn->query("SELECT * FROM comite;");
            $results->setFetchMode(PDO::FETCH_ASSOC);
            
            echo '<table>
            <thead>
            <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Nombre de membres</th>
            <th>Action</th>
            
            </tr>
            </thead>
            <tbody>';
            foreach($results as $ligne):?>
                <tr>
                    <td><?= $ligne['id_comite'] ?></td>
                    <td><?= $ligne['nom_comite']?></td>
                    <td><?= $ligne['nb_membre']?></td>
                    <td><a href="modification.php?id_comite=<?= $ligne['id_comite']?>">✏️</a>
                    <a href="suppresion.php?id_comite=<?= $ligne['id_comite'] ?>">❌</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <?php
        }
        //REVUES
        if($type=='revues'){
            $results=$conn->query("SELECT * FROM revue;");
            $results->setFetchMode(PDO::FETCH_ASSOC);
            
            echo '<table>
            <thead>
            <tr>
            <th>Référence</th>
            <th>Nom</th>
            <th>Site</th>
            <th>Identifiant Comité</th>
            <th>Action</th>
            
            </tr>
            </thead>
            <tbody>';
            foreach($results as $ligne):?>
                <tr>
                    <td><?= $ligne['ref_revue'] ?></td>
                    <td><?= $ligne['nom_revue']?></td>
                    <td><?= $ligne['url_revue']?></td>
                    <td><?= $ligne['id_comite']?></td>
                    <td><a href="modification.php?ref_revue=<?= $ligne['ref_revue']?>">✏️</a>
                    <a href="suppresion.php?ref_revue=<?= $ligne['ref_revue'] ?>">❌</a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <?php
        }
}


///////////////////////////////AJOUTER/////////////////////////////////////////
    elseif($action=='ajouter'){
        if($type=='auteurs') header("Location:ajout.php?table=auteurs");
        if($type=='articles') header("Location:ajout.php?table=articles");
        if($type=='comites') header("Location:ajout.php?table=comites");
        if($type=='revues') header("Location:ajout.php?table=revues");
    }
}
?>