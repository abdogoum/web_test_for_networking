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
    <title>Tache6</title>
</head>
<body>

<?php

require('classes.php');
session_start();

$all_ids = select_Classe_ids($conn);

?>

<form class="cnt" action="tache6.php" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Identifiant de l'etudiant</label>
        <div class="form-control">
            <SELECT name="selectd_id" size="1" >
                <?php 
                    
                    foreach($all_ids as $value){
                        echo "<OPTION>".$value;
                    }
                ;?>
            </SELECT>
            <input type="submit" name="btn_sele" value="Choisir" >
        </div>
  </div>

  <?php

    if (isset($_POST['btn_sele'])){
        $id = $_POST['selectd_id'];
        $array=tache6($conn,$id);
    }
?>
  <div class="form-group">
    <label for="formGroupExampleInput">Moyenne générale d'une classe</label>
    <div class="form-control"> <?php if(isset($_POST['btn_sele'])){ echo "Nom de la classe: ".$array[0]."|Moyenne de la classe: ".$array[1];}?> </div>
  </div>

</form>

</body>
</html>