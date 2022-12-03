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
    <title>Tache2</title>
</head>
<body>

    <?php

    require('classes.php');
    session_start();

    //$ETU1->Matieres = array( $matier1->ID => 15);

    //print_r($ETU1->Matieres);

    
    if (isset($_POST['submit_btn'])){
            $etudiant = new Etudiant($_POST['id_etu'],$_POST['nom_etu'],$_POST['prenom_etu']);
            $etudiant->insert_notes_des_etudiants($_POST['Maths_etu'],$_POST['Physiques_etu'],$_POST['Biologie_etu'],$_POST['Informatique_etu'],$_POST['Anglais_etu']);
            $_SESSION["data_etu"][] = $etudiant;

            // db insertion
            Insert_Into_Db($conn,$etudiant);
            //
        }
    ?>

<form class="cnt" action="tache2.php" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Identifiant de l'etudiant</label>
    <input name="id_etu" type="number" class="form-control" id="formGroupExampleInput" placeholder="Entrez l'id">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Nom de l'etudiant</label>
    <input name="nom_etu" type="text" class="form-control" id="formGroupExampleInput" placeholder="Entrez le Nom">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Prénom de l'etudiant</label>
    <input name="prenom_etu" type="text" class="form-control" id="formGroupExampleInput" placeholder="Entrez le Prénom">
  </div>


   <div class="form-group">
        <label for="formGroupExampleInput2">Maths</label>
        <input name="Maths_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note">
    </div>

    <div class="form-group">
        <label for="formGroupExampleInput2">Physiques</label>
        <input name="Physiques_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Biologié</label>
        <input name="Biologie_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Informatique</label>
        <input name="Informatique_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Anglais</label>
        <input name="Anglais_etu" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note">
    </div>

    <div class="form-group">
        <input name="submit_btn" type="submit" class="form-control" id="formGroupExampleInput2">
        <a href="afficher_tache2.php" class="form-control btn btn-info" >Afficher</a>
    </div>

</form>

</body>
</html>