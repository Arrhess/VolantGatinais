<?php
    require_once "./require/connect.php";
    require_once "./require/header.php";

    $id = $_GET['edit'];
    $sql = "SELECT * FROM `inscriptions` WHERE `ID` ='$id'";
    $conn = $db->prepare($sql);
    $conn ->execute();

       if (!empty($_POST)){

        $id = $_GET['edit'];

        $Joueur1 = strip_tags($_POST["Joueur1"]);
        $Joueur2 = htmlspecialchars($_POST["Joueur2"]);
        $Poule = ($_POST["Poule"]);

        $sql = "UPDATE `inscriptions`SET `poule`= '$Poule' WHERE `ID`= '$id'";

        $db->exec($sql);

        header("location:Liste_joueurs.php");

        if (isset($_POST["Poule"])){

            $Concat_Nom_Poule = "poule".$_POST["Poule"];
            $Concat_Joueurs = $_POST["Poule"];

            if ($Concat_Nom_Poule != "poule0"){
                $sqlCalc = "CREATE TABLE IF NOT EXISTS $Concat_Nom_Poule (id INT AUTO_INCREMENT PRIMARY KEY,Equipe VARCHAR(255),Poule VARCHAR (255), Nb_Matchs INT, Nb_Sets INT, Nb_Points INT, Classement_poule INT)";
                $db->exec($sqlCalc);
            

            $Equipe = $Joueur1."/".$Joueur2;


            $sqlCalc2 = "SELECT Equipe FROM $Concat_Nom_Poule WHERE Equipe = '$Equipe'";
            $requete = $db->query($sqlCalc2);

            $test = $requete->FetchAll();

            $Object = "";

                foreach ($test as $tests):

                    $Object = $tests["Equipe"];

                endforeach;
                    
                    if ($Object != $Equipe) {



                        $sqlCalc3 = "INSERT INTO $Concat_Nom_Poule (Equipe,Poule) VALUES ('$Equipe','$Poule')";
                        $db->exec($sqlCalc3);
                        }
            }
                    
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
            <input type="submit" value="Enregistrer" />

            <?php endforeach; ?>

        </form>
    </div>

    
</body>


</html>