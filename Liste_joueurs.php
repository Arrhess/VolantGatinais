<?php 

require_once "./require/header.php";
require "./require/connect.php";
//Affichage de la base de données

$sql = "SELECT * FROM `inscriptions` ORDER BY `Poule` asc";
$requete = $db->query($sql);
$joueurs = $requete->FetchAll();


if (isset ($_POST["supprimer_scores"])){
    $sql1 = "UPDATE inscriptions SET Nb_Matchs = NULL";
    $sql2 = "UPDATE inscriptions SET Nb_Sets = NULL";
    $sql3 = "UPDATE inscriptions SET Nb_Points = NULL";

    $requete1 = $db->exec($sql1);
    $requete2 = $db->exec($sql2);
    $requete3 = $db->exec($sql3);
}

//paramétrage des poules

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./JS/script.js" defer></script>
    <link rel="stylesheet" href="./CSS/style.css"/>
</head>



<body>
<section class="Body">
    <section id="Titre">
        <label id="Text"> Joueurs</label>
        <a id="Ajout_Equip" href="Ajout_Equipes.php">Ajouter une equipe</a>
        <form method="post">
            <div class="Boutton">
                <button class="action" type="submit" name="supprimer_scores">Supprimer les scores</button>
            </div>
        </form>
    </section>

    <br>

    <section class="entete">
        <label class="titre">Joueur 1</label>
        <label class="titre">Joueur 2</label>
        <label class="titre">Poule</label>
    </section>

    <section class="bdd">
        <?php foreach($joueurs as $joueur):?>
        <div class = "Joueurs_liste">
                <article class="art"><?php echo $joueur ["Joueur1"]." /"; ?></article>
                <article class="art"><?php echo $joueur ["Joueur2"]; ?></article>
                <article class="art"><?php echo "- P ".$joueur["Poule"];?></article>

        </div>
        <div class="Boutton">
            <a class="action" href="Modifier_Equipes.php?edit=<?php echo $joueur ["ID"]?>" > Modifier</a>
            <a class="action" href="Supprimer_Equipe.php?sup= <?php echo $joueur ["ID"]?>"> Supprimer</a>
        </div>

        <?php endforeach; ?>
    </section>
</section>
</body>

</html>


