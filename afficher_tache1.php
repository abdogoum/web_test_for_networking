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
    <title>Document</title>
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
    $myobject = end($all_students);

?>
    <table class="table table-dark table-striped cnt">
        <tr>
            <td>Id</td>
            <td><?php echo $myobject->ID ; ?></td>
        </tr>
        <tr>
            <td>nom</td>
            <td><?php echo $myobject->Nom ; ?></td>
        </tr>
        <tr>
            <td>Prénom</td>
            <td><?php echo $myobject->Prenom ; ?></td>
        </tr>
        <tr>
            <td>maths</td>
            <td><?php echo $myobject->Matieres["1"] ; ?></td>
        </tr>
        <tr>
            <td>Physiques</td>
            <td><?php  echo $myobject->Matieres["2"] ; ?></td>
        </tr>
        <tr>
            <td>Biologié</td>
            <td><?php echo $myobject->Matieres["3"] ; ?></td>
        </tr>
        <tr>
            <td>Informatique</td>
            <td><?php echo $myobject->Matieres["4"] ; ?></td>
        </tr>
        <tr>
            <td>Anglais</td>
            <td><?php echo $myobject->Matieres["5"] ;?></td>
        </tr>
    </table>
</body>
</html>