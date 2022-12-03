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
    <title>Tache5</title>
</head>
<body>

<?php

require('classes.php');
session_start();

$Mat_ids = select_Matiére_ids($conn);
$Clas_ids = select_Classe_ids($conn);

?>

<form class="cnt" action="tache5.php" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Matiére</label>
        <div class="form-control">
            <SELECT name="selectd_id" size="1" >
                <?php 
                    
                    foreach($Mat_ids as $value){
                        echo "<OPTION>".$value;
                    }
                ;?>
            </SELECT>
        </div>
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput">Classe</label>
        <div class="form-control">
            <SELECT name="selectd_id" size="1" >
                <?php 
                    
                    foreach($Clas_ids as $value){
                        echo "<OPTION>".$value;
                    }
                ;?>
            </SELECT>
            <input type="submit" name="btn_sele" value="Choisir" >
        </div>
  </div>

  <?php



    if (isset($_POST['btn_sele'])){
        $mat = $_POST['selectd_id'];
        $clas = $_POST['selectd_id'];
        $array=tache5($conn,$mat,$clas);
    }
?>
  <div class="form-group">
    <label for="formGroupExampleInput">Moyenne de la classe sur une matiére</label>
    <div class="form-control"> <?php if(isset($_POST['btn_sele'])){  echo "Nom classe : ".$array[0]."|Nom Matiere: ".$array[1]."|Moyenne de la classe: ".$array[2] ;} ?> </div>
  </div>

</form>

</body>
</html>