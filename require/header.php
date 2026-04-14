<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le volant Gatinais</title>
    <script src="./JS/script.js" defer></script>
    <link rel="stylesheet" href="./CSS/style.css"/>
</head>
<body>
    
</body>
</html>
<header>

<section class="header_element">
    <h1>Le Volant Gatinais</h1>
    <h3>
<?php
$page = basename($_SERVER["PHP_SELF"]);
    if ($page == "Liste_joueurs.php"){
        echo "Accueil";
    }else if ($page == "Poules.php"){
        echo "Poules";
    }else if ($page == "Modifier_Equipes.php"){
        echo "Modification d'équipe";
    }else if ($page == "Supprimer_Equipe.php"){
         echo "Suppression d'équipe";
    }else if ($page == "Ajout_Equipes.php"){
         echo "Ajouter une équipe";
    }else echo "Tableaux";
?>
    </h3>

<div class="Defilement">
    <div class="Nav_Link">
    <a class="menu" href="Liste_joueurs.php">Accueil</a>
    <a class="menu" href="Poules.php">Poules</a>
    <a class="menu" id="tableau" href="Tableaux.php">Tableaux</a>
    </div>
    <img class="Barre_Def" src="./Images/Barre_Menu.png" alt="Barre_def_menu">
</div>
</section>


</header>