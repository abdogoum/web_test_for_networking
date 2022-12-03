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
    <title>Tache10</title>
</head>
<body>

<?php

require('classes.php');
session_start();

$all_ids = select_Matiére_ids($conn);

?>

<form class="cnt" action="tache10.php" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">Identifiant de la Matiere</label>
        <div class="form-control">
            <SELECT name="selectd_id" size="1" >
                <?php 
                    
                    foreach($all_ids as $value){
                        echo "<OPTION>".$value;
                    }
                ;?>
            </SELECT>
        </div>
  </div>

  <?php

    if (isset($_POST['btn_sele'])){
        $mat = $_POST['selectd_id'];
        $note = (float)$_POST['note'];
    }
?>
  <div class="form-group">
        <label for="formGroupExampleInput2">Entrez la note éliminatoire</label>
        <input name="note" type="number" step="any" class="form-control" id="formGroupExampleInput2" placeholder="Entrez la note éliminatoire">
    </div>
    
    
    <input type="submit" name="btn_sele" value="Choisir" >

  <div class="form-group">
    <label for="formGroupExampleInput">Moyenne de l'etudiant</label>

    <table class="table table-success table-striped">
        <tr>
            <td>Id etudiant</td>
            <td>Nom d'etudiant</td>
            <td>ID matiére</td>
            <td>Nom de la Matiére</td>
            <td>ID classe</td>
            <td>Note</td>
        </tr>

    <?php

    if (isset($_POST['btn_sele'])){


        $sql = "SELECT etudiant.ID_etudiant, etudiant.Nom, matiere.ID, matiere.Nom as nomMat,etudiant.ID_classe,Note
        FROM  etudiant
        INNER JOIN note ON etudiant.ID_etudiant= note.ID_etudiant INNER JOIN matiere ON matiere.ID = note.ID_matiere
        WHERE note.ID_matiere = ".$mat."  AND note.Note <= ".$note."
        ORDER BY Note DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             
            echo "<tr>";
                echo "<td>";
                    echo $row['ID_etudiant'];
                echo "</td>";
                echo "<td>";
                    echo $row['Nom'];
                echo "</td>";
                echo "<td>";
                    echo $row['ID'];
                echo "</td>";
                echo "<td>";
                    echo $row['nomMat'];
                echo "</td>";
                echo "<td>";
                    echo $row['ID_classe'];
                echo "</td>";
                echo "<td>";
                    echo $row['Note'];
                echo "</td>";
             echo "</tr>";
        }
    }
}
?>
    </table>
  </div>

</form>

</body>
</html>