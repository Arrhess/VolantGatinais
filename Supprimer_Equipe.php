<?php
    require_once "./require/connect.php";
    require_once "./require/header.php";

    $id = $_GET['sup'];
    $sql = "SELECT * FROM `inscriptions` WHERE `ID` ='$id'";
    $conn = $db->prepare($sql);
    $conn ->execute();

       if (!empty($_POST)){

        $id = $_GET['sup'];

        $Nom = strip_tags($_POST["Joueur1"]);
        $Prénom = htmlspecialchars($_POST["Joueur2"]);
        $Poule = ($_POST["Poule"]);

        $sql = "DELETE FROM `inscriptions` WHERE `ID`= '$id'";

        $db->exec($sql);

        header("location:Liste_joueurs.php");

    } 


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
            <?php foreach ($conn as $ide): ?>
            <label>Joueur 1</label>
            <input id="form" type="text" name="Joueur1" value="<?php echo $ide["Joueur1"]; ?>" />
            <br>
            <label>Joueur 2</label>
            <input id="form" type="text" name="Joueur2" value="<?php echo $ide["Joueur2"]; ?>" />
            <br>
            <label>Poule</label>
            <input id="form" type="Int" name="Poule" value="<?php echo $ide["Poule"]; ?>">
            <br>
            <input type="submit" value="Supprimer" />

            <?php endforeach; ?>

        </form>
    </div>

    
</body>


</html>