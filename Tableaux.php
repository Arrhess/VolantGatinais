<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le volant Gatinais</title>
    <link rel="stylesheet" href="./CSS/style.css"/>
    <script src="./JS/script.js" defer></script>
</head>

<?php
    require_once "./require/header.php";
    require_once "./require/connect.php";
?>

<?php

//Paramètres tableau principal

    if (!empty($_POST["Prenom1_P"])){
        if(isset($_POST["Prenom1_P"], $_POST["Prenom2_P"]) && !empty($_POST["Prenom1_P"]) && !empty($_POST["Prenom2_P"])){

            $equipe1_P = $_POST["Prenom1_P"];
            $equipe2_P = $_POST["Prenom2_P"];

            $sql = "INSERT INTO tableau_principal (equipe1,equipe2) VALUES ('$equipe1_P','$equipe2_P')";
            $requete = $db ->exec($sql);

        }}

            if(isset($_POST["Remise_Zero_P"])){
            $sql = "TRUNCATE TABLE tableau_principal";
            $requete = $db ->exec($sql);
            header("location:Tableaux.php");
            }

            $sql2 = "SELECT * FROM tableau_principal";
            $requete2 = $db->query($sql2);
            $equipes_P = $requete2->FetchAll();

//Paramètres tableau consolante

    if (!empty($_POST["Prenom1_C"])){
        if(isset($_POST["Prenom1_C"], $_POST["Prenom2_C"]) && !empty($_POST["Prenom1_C"]) && !empty($_POST["Prenom2_C"])){

            $equipe1_C = $_POST["Prenom1_C"];
            $equipe2_C = $_POST["Prenom2_C"];

            $sql = "INSERT INTO tableau_consolante (equipe1,equipe2) VALUES ('$equipe1_C','$equipe2_C')";
            $requete = $db ->exec($sql);

        }}

            if(isset($_POST["Remise_Zero_C"])){
            $sql = "TRUNCATE TABLE tableau_consolante";
            $requete = $db ->exec($sql);
            header("location:Tableaux.php");
            }

            $sql2 = "SELECT * FROM tableau_consolante";
            $requete2 = $db->query($sql2);
            $equipes_C = $requete2->FetchAll();



?>

<H3> Tableau Principal</H3>

<div class="Boutton"> 

    <form method="post">
        <label for="" >Prénom 1</label>
        <input type="text" name="Prenom1_P">
        <label for="">Prénom 2</label>
        <input type="text" name="Prenom2_P">

        <input type ="submit" value ="Valider">

        <button name="Remise_Zero_P"> Remise à zéro</button>
    </form>
</div>


<br>



    <body>
    <section class="Principale">

    <section class="un">
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisibletrois" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="deux">
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
    </section>

    <section class="quatre">
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
    </section>
<!-- Declaration des Equipes -->
    <section class="huit">

    <?php 
            foreach($equipes_P as $equipe_P):?>
                <div id="Binome" class="equipe" draggable="true"><?php echo $equipe_P["equipe1"]." / ".$equipe_P["equipe2"] ?></div>
            <?php endforeach;?>


    </section>
<!-- Declaration des Equipes -->
    <section class="quatre">
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
    </section>

    <section class="deux">
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
    </section>

    <section class="un">
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisibletrois" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>
    </section>

    <!-- perdant tableau principale -->

    <section class="Principale">

    <section class="perdant">
        <h5>place 15/16</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>Perdants Quarts</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>place 13/14</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>place 7/8</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>Perdants Quarts</h5>       
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>place 5/6</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>
    </section>



<?php //Tableau Consoloante ?>

<H3> Tableau Consolante</H3>

<div class="Boutton"> 

    <form method="post">
        <label for="" >Prénom 1</label>
        <input type="text" name="Prenom1_C">
        <label for="">Prénom 2</label>
        <input type="text" name="Prenom2_C">

        <input type ="submit" value ="Valider">

        <button name="Remise_Zero_C"> Remise à zéro</button>
    </form>
</div>

    <section class="Principale">

    <section class="un">
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisibletrois" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="deux">
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
    </section>

    <section class="quatre">
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
    </section>
<!-- Declaration des Equipes -->
    <section class="huit">

    <?php 
            foreach($equipes_C as $equipe_C):?>
                <div id="Binome" class="equipe" draggable="true"><?php echo $equipe_C["equipe1"]." / ".$equipe_C["equipe2"] ?></div>
            <?php endforeach;?>


    </section>
<!-- Declaration des Equipes -->
    <section class="quatre">
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisible" draggable="false"></div>
    </section>

    <section class="deux">
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
        <div id="invisibledeux" class="equipe" draggable="true"></div>
    </section>

    <section class="un">
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="invisibletrois" draggable="false"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>
    </section>

    <!-- perdant tableau principale -->

    <section class="Principale">

    <section class="perdant">
        <h5>place 15/16</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>Perdants Quarts</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>place 13/14</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>place 7/8</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>Perdants Quarts</h5>       
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>

    <section class="perdant">
        <h5>place 5/6</h5>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="nul"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>
    </section>


    <section class="classement_tableau">
        <h4>Classement Final principal</h4>

    <section class="position">
    <section class="classement">
        <div id="pos" >1</div>
        <div id="pos" >2</div>
        <div id="pos" >3</div>
        <div id="pos" >4</div>
        <div id="pos" >5</div>
        <div id="pos" >6</div>
        <div id="pos" >7</div>
        <div id="pos" >8</div>
        <div id="pos" >9</div>
        <div id="pos" >10</div>
        <div id="pos" >11</div>
        <div id="pos" >12</div>
        <div id="pos" >13</div>
        <div id="pos" >14</div>
        <div id="pos" >15</div>
        <div id="pos" >16</div>
    </section>
    <section class="classement">
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>
    </section>

            <h4>Classement Final consolante</h4>

    <section class="position">
    <section class="classement">
        <div id="pos" >1</div>
        <div id="pos" >2</div>
        <div id="pos" >3</div>
        <div id="pos" >4</div>
        <div id="pos" >5</div>
        <div id="pos" >6</div>
        <div id="pos" >7</div>
        <div id="pos" >8</div>
        <div id="pos" >9</div>
        <div id="pos" >10</div>
        <div id="pos" >11</div>
        <div id="pos" >12</div>
        <div id="pos" >13</div>
        <div id="pos" >14</div>
        <div id="pos" >15</div>
        <div id="pos" >16</div>
    </section>
    <section class="classement">
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
        <div id="seize" class="equipe" draggable="true"></div>
    </section>
    </section>

    </section>
    

    </body>




