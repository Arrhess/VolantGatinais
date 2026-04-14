<?php
    require_once "./require/connect.php";
    require_once "./require/header.php";


    if (!empty($_POST)){
        if(
            isset($_POST["Joueur1"], $_POST["Joueur2"])
            && !empty($_POST["Joueur1"]) && !empty($_POST["Joueur2"])
        ){

            $Joueur1 = strip_tags($_POST["Joueur1"]);
            $Joueur2 = htmlspecialchars($_POST["Joueur2"]);
            $Equipe = $Joueur1."/".$Joueur2;

            $sql = "INSERT INTO inscriptions (Joueur1,Joueur2,Equipe,poule) VALUES ('$Joueur1', '$Joueur2','$Equipe',0)";

            $db->exec($sql);

            $ID = $db->LastInsertId();
            header("location:Liste_joueurs.php");
    }}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css"/>
</head>


<body>

    <div id="formulaire">
        <form method="post">

            <label>Joueur 1</label>
            <input id="form" type="text" name="Joueur1" />
            <br>
            <label>Joueur 2</label>
            <input id="form" type="text" name="Joueur2" />
            <br>
            <input type="submit" value="Enregistrer" />

        </form>
    </div>

    
</body>


</html>