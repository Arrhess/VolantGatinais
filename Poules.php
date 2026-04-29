<?php 
require_once "./require/header.php";
require_once "./require/connect.php";

// Récupération de la base inscriptions
$sql = "SELECT * FROM `inscriptions` ORDER BY `Poule` asc , `Nb_Matchs`desc, `Nb_Sets` desc, `Nb_Points`Desc ";
$requete = $db->query($sql);
$Equipe = $requete->FetchAll();
?>


<body>

<?php


if (!empty ($_POST["Poule"])){

        $Poule = $_POST["Poule"];
        $Poule_select = "poule".$_POST["Poule"];
        $Match_poule = $Poule_select."_matchs";

        $delete_poule = "DROP TABLE levolantgatinais_bdd.$Poule_select";
        $delete_poule_matchs = "DROP TABLE levolantgatinais_bdd.$Match_poule";
        $delete_numero_poule_inscription = "UPDATE inscriptions SET Poule = 0 WHERE Poule = $Poule";

        $requete_delete_poule = $db ->exec($delete_poule);
        $requete_delete_poule_matchs = $db ->exec($delete_poule_matchs);
        $requete_delete_poule_inscriptions = $db ->exec($delete_numero_poule_inscription);

}

// Définition de la variable $Nombre_Poule pour déterminer le nombre de Poules à créer
 $Nombre_Poule = 0; 
 ?> 


<section id="Affich">

        <div class="Liste">

<?php
// Affichage de la base inscriptions avec une indication de la Poule dans laquel se trouve l'equipe 
         foreach($Equipe as $Equipes):
                if ($Nombre_Poule != $Equipes ["Poule"]){?>
                <label class="Tpoule"> Poule <?php echo $Equipes["Poule"]; ?> : </label>
        <?php $Nombre_Poule += 1; }?>
                <div class="Equipe_List">
                <article class="art"><?php echo $Equipes ["Equipe"]; ?></article>
                <article class="art"><?php echo $Equipes ["Nb_Matchs"]; ?></article>
                <article class="art"><?php echo $Equipes ["Nb_Sets"]; ?></article>
                <article class="art"><?php echo $Equipes ["Nb_Points"]; ?></article>
                </div>
        <?php endforeach; 
?>

        </div>

        <div class="Container1">

        <div>   
               <form method="post">
                <input type="submit" name="Creation_Poule" class="action2" value="Afficher les matchs de poules">
                </form>
        </div>

<?php 
// Pour chaque Poule à créer, affichage du titre "Matchs Poule"

                $test = "SELECT COUNT(*) from inscriptions where poule = 0";
                $requete_test = $db->query($test);
                $Nb_zero = $requete_test -> FetchAll();

                foreach ($Nb_zero as $Nb_zeros):
                        $Nb_Equipe_SansPoule = $Nb_zeros["COUNT(*)"];
                endforeach;
                        
if ($Nb_Equipe_SansPoule > 0){
        echo "Impossible d'afficher les poules car celles-ci ne sont pas encore créés";
}else {

        $y = 1;
        for($i=1 ; $i<= $Nombre_Poule; $i++){
                $Nom_Table = "poule".$i;
                
                if ($y == $i){
                        echo "Matchs Poule ".$i.":<br><br>";
                }else{
                        $y++;
                        echo "<br>Matchs Poule ".$y.":<br><br>";
                } 


// Récupération du nombre de lignes présentes dans la Table $Nom_Table 
                $sql2 = "SELECT COUNT(*) FROM $Nom_Table";
                $requete2 = $db->query($sql2);
                $Nb_Joueur = $requete2->FetchAll();
// Récupération de la case "Equipe" de la table $Nom_Table
                $sql3 = "SELECT Equipe FROM $Nom_Table";
                $requete3 = $db->query($sql3);
                $joueur = $requete3->FetchAll();

                $Nom_Table_Match = $Nom_Table."_matchs"; 

// Si $_POST n'est pas vide (donc quand on appuie sur le boutton "Création Poule"), création d'une table $Nom_Table_Match 
        if(!empty($_POST["Creation_Poule"])){ 

                        $sql = "CREATE TABLE IF NOT EXISTS $Nom_Table_Match (id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY, equipe1 varchar (255) ,equipe2 varchar (255) ,score_set1_equipe1 INT,score_set1_equipe2 INT ,score_set2_equipe1 INT ,score_set2_equipe2 INT ,score_set3_equipe1 INT ,score_set3_equipe2 INT ,equipe_victoire varchar (255),statut varchar (255))";
                        $requete = $db->exec($sql); 

                        $sqltest = "SELECT * FROM $Nom_Table";
                        $requetetest = $db->query($sqltest);
                        $Nb_Joueurtest = $requetetest->FetchAll(); 

                        $Equipe = [];

                        foreach ($Nb_Joueur as $Nb_Joueurs):
                                $Nombre_joueur = $Nb_Joueurs["COUNT(*)"];
                        endforeach;

                        $Tableaux = [];

                        foreach ($joueur as $joueurs):
                                array_push($Tableaux,$joueurs["Equipe"]);
                        endforeach;

// Création des matchs dans les bases de données correspondantes à la poule

                        if ($Nombre_joueur == 3){
                                $equipe1 = $Tableaux[0];
                                $equipe2 = $Tableaux[1];
                                $equipe3 = $Tableaux[2];

                                $Test_Match_Existant = "SELECT COUNT(*) FROM $Nom_Table_Match";
                                $requete_Test = $db ->query($Test_Match_Existant);
                                $nb_match_poule = $requete_Test->FetchAll();


                                foreach ($nb_match_poule as $Nb_Match):
                                        $Nombre_matchs = $Nb_Match["COUNT(*)"];
                                endforeach;

                                if ($Nombre_matchs != 3){

                                $insert_Match1 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe2','En Attente')";
                                $insert_Match2 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe3','En Attente')";
                                $insert_Match3 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe3','En Attente')";
                                
                                $requete_insertMatch1 = $db ->exec($insert_Match1);
                                $requete_insertMatch2 = $db ->exec($insert_Match2);
                                $requete_insertMatch3 = $db ->exec($insert_Match3);
                                }

                        }else if ($Nombre_joueur == 4){

                                $Test_Match_Existant = "SELECT COUNT(*) FROM $Nom_Table_Match";
                                $requete_Test = $db ->query($Test_Match_Existant);
                                $nb_match_poule = $requete_Test->FetchAll();


                                foreach ($nb_match_poule as $Nb_Match):
                                        $Nombre_matchs = $Nb_Match["COUNT(*)"];
                                endforeach;

                                if ($Nombre_matchs != 6){

                                $equipe1 = $Tableaux[0];
                                $equipe2 = $Tableaux[1];
                                $equipe3 = $Tableaux[2];
                                $equipe4 = $Tableaux[3];

                                $insert_Match1 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe2','En Attente')";
                                $insert_Match2 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe3','En Attente')";
                                $insert_Match3 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe4','En Attente')";
                                $insert_Match4 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe3','En Attente')";
                                $insert_Match5 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe4','En Attente')";
                                $insert_Match6 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe3','$equipe4','En Attente')";
                                
                                $requete_insertMatch1 = $db ->exec($insert_Match1);
                                $requete_insertMatch2 = $db ->exec($insert_Match2);
                                $requete_insertMatch3 = $db ->exec($insert_Match3);
                                $requete_insertMatch4 = $db ->exec($insert_Match4);
                                $requete_insertMatch5 = $db ->exec($insert_Match5);
                                $requete_insertMatch6 = $db ->exec($insert_Match6);

                                }

                        }else if ($Nombre_joueur == 5){

                                $Test_Match_Existant = "SELECT COUNT(*) FROM $Nom_Table_Match";
                                $requete_Test = $db ->query($Test_Match_Existant);
                                $nb_match_poule = $requete_Test->FetchAll();

                                foreach ($nb_match_poule as $Nb_Match):
                                        $Nombre_matchs = $Nb_Match["COUNT(*)"];
                                endforeach;

                                if ($Nombre_matchs != 10){

                                $equipe1 = $Tableaux[0];
                                $equipe2 = $Tableaux[1];
                                $equipe3 = $Tableaux[2];
                                $equipe4 = $Tableaux[3];
                                $equipe5 = $Tableaux[4];

                                $insert_Match1 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe2','En Attente')";
                                $insert_Match2 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe3','En Attente')";
                                $insert_Match3 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe4','En Attente')";
                                $insert_Match4 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe5','En Attente')";
                                $insert_Match5 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe3','En Attente')";
                                $insert_Match6 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe4','En Attente')";
                                $insert_Match7 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe5','En Attente')";
                                $insert_Match8 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe3','$equipe4','En Attente')";
                                $insert_Match9 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe3','$equipe5','En Attente')";
                                $insert_Match10 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe4','$equipe5','En Attente')";

                                $requete_insertMatch1 = $db ->exec($insert_Match1);
                                $requete_insertMatch2 = $db ->exec($insert_Match2);
                                $requete_insertMatch3 = $db ->exec($insert_Match3);
                                $requete_insertMatch4 = $db ->exec($insert_Match4);
                                $requete_insertMatch5 = $db ->exec($insert_Match5);
                                $requete_insertMatch6 = $db ->exec($insert_Match6);
                                $requete_insertMatch7 = $db ->exec($insert_Match7);
                                $requete_insertMatch8 = $db ->exec($insert_Match8);
                                $requete_insertMatch9 = $db ->exec($insert_Match9);
                                $requete_insertMatch10 = $db ->exec($insert_Match10);

                                }

                        }else if ($Nombre_joueur == 6){

                                $Test_Match_Existant = "SELECT COUNT(*) FROM $Nom_Table_Match";
                                $requete_Test = $db ->query($Test_Match_Existant);
                                $nb_match_poule = $requete_Test->FetchAll();

                                foreach ($nb_match_poule as $Nb_Match):
                                        $Nombre_matchs = $Nb_Match["COUNT(*)"];
                                endforeach;

                                if ($Nombre_matchs != 15){

                                $equipe1 = $Tableaux[0];
                                $equipe2 = $Tableaux[1];
                                $equipe3 = $Tableaux[2];
                                $equipe4 = $Tableaux[3];
                                $equipe5 = $Tableaux[4];
                                $equipe6 = $Tableaux[5];

                                $insert_Match1 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe2','En Attente')";
                                $insert_Match2 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe3','En Attente')";
                                $insert_Match3 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe4','En Attente')";
                                $insert_Match4 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe1','$equipe5','En Attente')";
                                $insert_Match5 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe6','En Attente')";
                                $insert_Match6 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe3','En Attente')";
                                $insert_Match7 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe4','En Attente')";
                                $insert_Match8 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe5','En Attente')";
                                $insert_Match9 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe2','$equipe6','En Attente')";
                                $insert_Match10 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe3','$equipe4','En Attente')";
                                $insert_Match11 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe3','$equipe5','En Attente')";
                                $insert_Match12 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe3','$equipe6','En Attente')";
                                $insert_Match13 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe4','$equipe5','En Attente')";
                                $insert_Match14 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe4','$equipe6','En Attente')";
                                $insert_Match15 = "INSERT INTO $Nom_Table_Match (equipe1,equipe2,statut) VALUES ('$equipe5','$equipe6','En Attente')";

                                $requete_insertMatch1 = $db ->exec($insert_Match1);
                                $requete_insertMatch2 = $db ->exec($insert_Match2);
                                $requete_insertMatch3 = $db ->exec($insert_Match3);
                                $requete_insertMatch4 = $db ->exec($insert_Match4);
                                $requete_insertMatch5 = $db ->exec($insert_Match5);
                                $requete_insertMatch6 = $db ->exec($insert_Match6);
                                $requete_insertMatch7 = $db ->exec($insert_Match7);
                                $requete_insertMatch8 = $db ->exec($insert_Match8);
                                $requete_insertMatch9 = $db ->exec($insert_Match9);
                                $requete_insertMatch10 = $db ->exec($insert_Match10);
                                $requete_insertMatch11 = $db ->exec($insert_Match11);
                                $requete_insertMatch12 = $db ->exec($insert_Match12);
                                $requete_insertMatch13 = $db ->exec($insert_Match13);
                                $requete_insertMatch14 = $db ->exec($insert_Match14);
                                $requete_insertMatch15 = $db ->exec($insert_Match15);
                                }
                        }


                        $Affichage_Matchs_P1 = "SELECT * FROM $Nom_Table_Match";
                        $requete_affichage_P1 = $db->query($Affichage_Matchs_P1);
                        $requete_affichage_query_P1 = $requete_affichage_P1->FetchAll();
        
                        foreach ($requete_affichage_query_P1 as $requete_affichage_query_P1S):?>
                        <section class="Score_a_remplir">
                                <label class="id"><?php echo $requete_affichage_query_P1S["id"]; ?></label>
                                <input class="equipe_affich" type="text" value="<?php echo $requete_affichage_query_P1S["equipe1"]; ?>">
                                <input class="set" type="text" value="<?php echo $requete_affichage_query_P1S["score_set1_equipe1"]; ?>">
                                <input class="set" type="text" value="<?php echo $requete_affichage_query_P1S["score_set2_equipe1"]; ?>">
                                <input class="set" type="text" value="<?php echo $requete_affichage_query_P1S["score_set3_equipe1"]; ?>">
                                <label for="">VS</label>
                                <input class="equipe_affich" type="text" value="<?php echo $requete_affichage_query_P1S["equipe2"]; ?>">
                                <input class="set" type="text" value="<?php echo $requete_affichage_query_P1S["score_set1_equipe2"]; ?>">
                                <input class="set" type="text" value="<?php echo $requete_affichage_query_P1S["score_set2_equipe2"]; ?>">
                                <input class="set" type="text" value="<?php echo $requete_affichage_query_P1S["score_set3_equipe2"]; ?>">
                                <?php
                                $Etat = $requete_affichage_query_P1S["statut"];
                                if ($Etat == "En Attente"){
                                       ?> <label class="statut" id="En_attente"><?php echo $requete_affichage_query_P1S["statut"]; ?></label> <?php
                                }else if ($Etat == "En Cours"){
                                        ?> <label class="statut" id="En_cours"><?php echo $requete_affichage_query_P1S["statut"]; ?></label> <?php
                                }else if ($Etat == "Terminé"){
                                        ?> <label class="statut" id="Termine"><?php echo $requete_affichage_query_P1S["statut"]; ?></label> <?php
                                }
                                ?>
                        </section>
                        <?php endforeach;}}} ?>

<?php
// Lancement d'un match et passage en statut "En Cours" dans la base de donnée
        if(isset ($_POST["poulelancement"])){
                $poule_lancement = "poule".$_POST["poulelancement"]."_matchs";
                $match_lancement = $_POST["matchlancement"];
                $sql = "UPDATE $poule_lancement SET statut = 'En Cours' WHERE id = '$match_lancement'";
                $requete = $db -> exec($sql);
        }

// Entrer le score du match selectionné dans la base de données
        if (!empty ($_POST["set1_equipe1"]) && !empty ($_POST["set2_equipe1"])){
                $poule = "poule".$_POST["poule_score"];
                $poule_score = "poule".$_POST["poule_score"]."_matchs";
                $match_score = $_POST["match_score"];

                $set1_equipe1 = $_POST["set1_equipe1"];
                $set1_equipe2 = $_POST["set1_equipe2"];
                $set2_equipe1 = $_POST["set2_equipe1"];
                $set2_equipe2 = $_POST["set2_equipe2"];
                $set3_equipe1 = $_POST["set3_equipe1"];
                $set3_equipe2 = $_POST["set3_equipe2"];

                $sql_match = "UPDATE $poule_score SET score_set1_equipe1 = '$set1_equipe1',
                                                score_set1_equipe2 = '$set1_equipe2',
                                                score_set2_equipe1 = '$set2_equipe1',
                                                score_set2_equipe2 = '$set2_equipe2',
                                                score_set3_equipe1 = '$set3_equipe1',
                                                score_set3_equipe2 = '$set3_equipe2'
                                WHERE id = '$match_score'";
                $requete = $db -> exec($sql_match);

// Si le joueur 1 gagne le match

                if (!empty ($_POST["equipe1"])){

                        $sql_joueurs = "SELECT * FROM $poule_score WHERE id = '$match_score'";
                        $requete_joueur = $db->query($sql_joueurs);
                        $joueur = $requete_joueur ->FetchAll();

                        foreach ($joueur as $joueurs):
                                $equipe1_joueur = $joueurs["equipe1"];
                                $equipe2_joueur = $joueurs["equipe2"];
                        endforeach;

                if ($joueurs["statut"] == "Terminé"){
                        echo "Impossible de modifier un match deja terminé";
                }else{

                        $sql_info = "SELECT * FROM $poule WHERE Equipe = '$equipe1_joueur'";
                        $requete = $db ->query($sql_info);
                        $info = $requete ->FetchAll();

                        foreach ($info as $infos):
                                $match = $infos["Nb_Matchs"];
                                $set = $infos["Nb_Sets"];
                                $points = $infos["Nb_Points"];
                        endforeach;

// Incrémentation Equipe 1

                        $score_match_j1 = $match += 1;
                        $set_gagne_j1 = $set += 2;

                        $set1 = $_POST["set1_equipe1"];
                        $set2 = $_POST["set2_equipe1"];

                        if (!empty ($_POST["set3_equipe1"])){
                                $set3 = $_POST["set3_equipe1"];
                        }else $set3 = 0 ;
                        
                        $point_j1 = $points += $set1 += $set2 += $set3;

                        $sql_poule1 = "UPDATE $poule SET Nb_Matchs = '$score_match_j1',
                                                        Nb_Sets = '$set_gagne_j1',
                                                        Nb_Points = '$point_j1'
                                        WHERE Equipe = '$equipe1_joueur'";

                        $sql_inscription1 = "UPDATE inscriptions SET Nb_Matchs = '$score_match_j1',
                                                        Nb_Sets = '$set_gagne_j1',
                                                        Nb_Points = '$point_j1'
                                        WHERE Equipe = '$equipe1_joueur'";

                        $requete = $db->exec($sql_inscription1);
                        $requete = $db->exec($sql_poule1);


// Incrémentation Equipe 2

                        $sql_info = "SELECT * FROM $poule WHERE Equipe = '$equipe2_joueur'";
                        $requete = $db ->query($sql_info);
                        $info = $requete ->FetchAll();

                        foreach ($info as $infos):
                                $match_j2 = $infos["Nb_Matchs"];
                                $set_j2 = $infos["Nb_Sets"];
                                $points_j2 = $infos["Nb_Points"];
                        endforeach;

                        if($infos["Nb_Matchs"] == 0){
                                $match_j2 == 0;
                        }

                        $score_match_j2 = $match_j2;
                        if (!empty ($_POST["set3_equipe2"])){
                                $set_gagne_j2 = $set_j2 += 1;
                        }else $set_gagne_j2 = 0;

                        $set1_j2 = $_POST["set1_equipe2"];
                        $set2_j2 = $_POST["set2_equipe2"];

                        if (!empty ($_POST["set3_equipe2"])){
                                $set3_j2 = $_POST["set3_equipe2"];
                        }else $set3_j2 = 0 ;

                        $point_j2 = $points_j2 += $set1_j2 += $set2_j2 += $set3_j2;

                        $sql_poule2 = "UPDATE $poule SET Nb_Matchs = '$score_match_j2',
                                                        Nb_Sets = '$set_gagne_j2',
                                                        Nb_Points = '$point_j2'
                                        WHERE Equipe = '$equipe2_joueur'";

                        $sql_inscription2 = "UPDATE inscriptions SET Nb_Matchs = '$score_match_j2',
                                                        Nb_Sets = '$set_gagne_j2',
                                                        Nb_Points = '$point_j2'
                                        WHERE Equipe = '$equipe2_joueur'";

                        $sql_statut = "UPDATE $poule_score SET 
                                                statut = 'Terminé'
                                        WHERE id = '$match_score'";
                $requete = $db -> exec($sql_match);

                        $requete = $db->exec($sql_inscription2);
                        $requete = $db->exec($sql_poule2);
                }

//Si l'equipe 2 gagne le match

                } else if (!empty($_POST["equipe2"])){
                        $sql_joueurs = "SELECT * FROM $poule_score WHERE id = '$match_score'";
                        $requete_joueur = $db->query($sql_joueurs);
                        $joueur = $requete_joueur ->FetchAll();

                        foreach ($joueur as $joueurs):
                                $equipe1_joueur = $joueurs["equipe1"];
                                $equipe2_joueur = $joueurs["equipe2"];
                        endforeach;

                if ($joueurs["statut"] == "Terminé"){
                        echo "Impossible de modifier un match deja terminé";
                }else{

                        $sql_info = "SELECT * FROM $poule WHERE Equipe = '$equipe2_joueur'";
                        $requete = $db ->query($sql_info);
                        $info = $requete ->FetchAll();

                        foreach ($info as $infos):
                                $match = $infos["Nb_Matchs"];
                                $set = $infos["Nb_Sets"];
                                $points = $infos["Nb_Points"];
                        endforeach;

// Incrémentation Equipe 2

                        $score_match_j2 = $match += 1;
                        $set_gagne_j2 = $set += 2;

                        $set1 = $_POST["set1_equipe2"];
                        $set2 = $_POST["set2_equipe2"];

                        if (!empty ($_POST["set3_equipe2"])){
                                $set3 = $_POST["set3_equipe2"];
                        }else $set3 = 0 ;
                        
                        $point_j2 = $points += $set1 += $set2 += $set3;

                        $sql_poule1 = "UPDATE $poule SET Nb_Matchs = '$score_match_j2',
                                                        Nb_Sets = '$set_gagne_j2',
                                                        Nb_Points = '$point_j2'
                                        WHERE Equipe = '$equipe2_joueur'";

                        $sql_inscription1 = "UPDATE inscriptions SET Nb_Matchs = '$score_match_j2',
                                                        Nb_Sets = '$set_gagne_j2',
                                                        Nb_Points = '$point_j2'
                                        WHERE Equipe = '$equipe2_joueur'";

                        $requete = $db->exec($sql_inscription1);
                        $requete = $db->exec($sql_poule1);


// Incrémentation Equipe 1

                        $sql_info = "SELECT * FROM $poule WHERE Equipe = '$equipe1_joueur'";
                        $requete = $db ->query($sql_info);
                        $info = $requete ->FetchAll();

                        foreach ($info as $infos):
                                $match_j1 = $infos["Nb_Matchs"];
                                $set_j1 = $infos["Nb_Sets"];
                                $points_j1 = $infos["Nb_Points"];
                        endforeach;

                        if($infos["Nb_Matchs"] == 0){
                                $match_j1 == 0;
                        }

                        $score_match_j1 = $match_j1;
                        if (!empty ($_POST["set3_equipe1"])){
                                $set_gagne_j1 = $set_j1 += 1;
                        }else $set_gagne_j1 = 0;

                        $set1_j1 = $_POST["set1_equipe1"];
                        $set2_j1 = $_POST["set2_equipe1"];

                        if (!empty ($_POST["set3_equipe1"])){
                                $set3_j1 = $_POST["set3_equipe1"];
                        }else $set3_j1 = 0 ;

                        $point_j1 = $points_j1 += $set1_j1 += $set2_j1 += $set3_j1;

                        $sql_poule2 = "UPDATE $poule SET Nb_Matchs = '$score_match_j1',
                                                        Nb_Sets = '$set_gagne_j1',
                                                        Nb_Points = '$point_j1'
                                        WHERE Equipe = '$equipe1_joueur'";

                        $sql_inscription2 = "UPDATE inscriptions SET Nb_Matchs = '$score_match_j1',
                                                        Nb_Sets = '$set_gagne_j1',
                                                        Nb_Points = '$point_j1'
                                        WHERE Equipe = '$equipe1_joueur'";

                        $requete = $db->exec($sql_inscription2);
                        $requete = $db->exec($sql_poule2);


                }}



        }
        
?>

        </div>

<div class="parametre_poule">
        <form method="post">
                <H4>Quelle Poule voulez vous supprimer ?</H4>
                <select class="set" type="text" name="Poule">
                        <option name="Poule">1</option>
                        <option name="Poule">2</option>
                        <option name="Poule">3</option>
                        <option name="Poule">4</option>
                        <option name="Poule">5</option>
                        <option name="Poule">6</option>
                </select>
                <button type="submit" class="action2" >Supprimer la poule</button>
        </form>

        <form method="post">
                <H4>Lancer un match</H4>
                <label> Selectionner la poule :</label>
                <select name="poulelancement">
                        <option >0</option>
                        <option >1</option>
                        <option >2</option>
                        <option >3</option>
                        <option >4</option>
                        <option >5</option>
                        <option >6</option>
                </select>
                <br>
                <label>Selectionner le match :</label>
                <select name="matchlancement">
                        <option >0</option>
                        <option >1</option>
                        <option >2</option>
                        <option >3</option>
                        <option >4</option>
                        <option >5</option>
                        <option >6</option>
                        <option >7</option>
                        <option >8</option>
                        <option >9</option>
                        <option >10</option>
                        <option >11</option>
                        <option >12</option>
                        <option >13</option>
                        <option >14</option>
                        <option >15</option>
                </select>
                <button type="submit" class="action2" >Valider</button>
        </form>

        <form method="post">
                <H4> Inserer un score :</H4>

                <label>Selectionner la poule :</label>
                <select name="poule_score">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                </select>

                <br>

                <label>Selectionner le match :</label>
                <select name="match_score">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option >7</option>
                        <option >8</option>
                        <option >9</option>
                        <option >10</option>
                        <option >11</option>
                        <option >12</option>
                        <option >13</option>
                        <option >14</option>
                        <option >15</option>
                </select>

                <br>
                <br>
        
                        <label>Set 1 :</label>
                        <input class="set" type="text" name="set1_equipe1">
                        <input class="set" type="text" name="set1_equipe2">
                                <br>
                        <label>Set 2 :</label>
                        <input class="set" type="text" name="set2_equipe1">
                        <input class="set" type="text" name="set2_equipe2">
                                <br>
                        <label>Set 3 :</label>
                        <input class="set" type="text" name="set3_equipe1">
                        <input class="set" type="text" name="set3_equipe2">

                        <H5>Victoire :</H5>
                        <label>Equipe 1</label>
                        <input type="checkbox" name="equipe1">
                        <label>Equipe 2</label>
                        <input type="checkbox" name="equipe2">

                        <br>
                        <br>    


                        <button type="submit" class="action2" >Valider</button>
                
        </form>

</div>







</section>
</body>

</html>