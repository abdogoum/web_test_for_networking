<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link rel="stylesheet" href="design.css">
    <title>Tache3</title>
</head>
<body>
    <?php

    require('classes.php');
    session_start();

    if(isset($_SESSION["data_etu"])){
        $all_students = $_SESSION["data_etu"];
    }else{
        $all_students = array();
    }

    
    if (isset($_POST['submit_btn'])){
            $myobject = get_object($all_students,(int)$_POST['submit_btn']);
            $myobject->change_nom_prenom($_POST['nom_etu'],$_POST['prenom_etu']);
            $myobject->insert_notes_des_etudiants($_POST['Maths_etu'],$_POST['Physiques_etu'],$_POST['Biologie_etu'],$_POST['Informatique_etu'],$_POST['Anglais_etu']);

            //db modify 
            modify_Db($conn,$myobject);
            //end

        }
    ?>

<form class="cnt" action="tache3.php" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Identifiant de l'etudiant</label>
        <div class="form-control">
            <SELECT name="selectd_id" size="1" >
                <?php 
                    
                    foreach($all_students as $value){
                        echo "<OPTION>".$value->ID;
                    }
                ;?>
            </SELECT>
            <input type="submit" name="btn_sele" value="Choisir" >
        </div>
                

    <?php 
            if(isset($_POST['btn_sele'])){
                $id = $_POST['selectd_id'];
                $myobject = get_object($all_students,$id);                
            }
        ;?>
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput">Nom de l'etudiant</label>
    <input name="nom_etu" type="text" class="form-control" id="formGroupExampleInput" placeholder="Entrez le Nom" value="<?php if(isset($_POST['btn_sele'])){ echo $myobject->Nom ;}?>" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Pr??nom de l'etudiant</label>
    <input name="prenom_etu" type="text" class="form-control" id="formGroupExampleInput" placeholder="Entrez le Pr??nom" value="<?php if(isset($_POST['btn_sele'])){ echo $myobject->Prenom ;}?>">
  </div>


   <div class="form-group">
        <label for="formGroupExampleInput2">Maths</label>
        <input name="Maths_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note" value="<?php if(isset($_POST['btn_sele'])){ echo $myobject->Matieres["1"] ;}?>">
    </div>

    <div class="form-group">
        <label for="formGroupExampleInput2">Physiques</label>
        <input name="Physiques_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note" value="<?php if(isset($_POST['btn_sele'])){ echo $myobject->Matieres["2"]  ;}?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Biologi??</label>
        <input name="Biologie_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note" value="<?php if(isset($_POST['btn_sele'])){ echo $myobject->Matieres["3"] ;}?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Informatique</label>
        <input name="Informatique_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note" value="<?php if(isset($_POST['btn_sele'])){ echo $myobject->Matieres["4"] ;}?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Anglais</label>
        <input name="Anglais_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note" value="<?php if(isset($_POST['btn_sele'])){  echo $myobject->Matieres["5"]  ;}?>">
    </div>

    <div class="form-group">
        <button name="submit_btn" type="submit" class="form-control" id="formGroupExampleInput2" value=<?php if(isset($_POST['btn_sele'])){ echo $id;} ?>>Submit</button>
        <a href="afficher_tache2.php" class="form-control btn btn-info" >Afficher</a>
    </div>

</form>

</body>
</html>