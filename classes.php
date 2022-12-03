<?php

    //db connection
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "methagile";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    //end

    class Etudiant {
    public $ID;
    public $Nom;
    public $Prenom;
    public $Matieres;


    function __construct($ID,$Nom,$Prenom) {
        $this->ID = $ID;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
    }
    function get_name() {
        return $this->Nom;
    }

    function change_nom_prenom($Nom,$Prenom){
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
    }

    function insert_notes_des_etudiants($Maths,$Physiques,$Biologié,$Informatique,$Anglais) {
        return $this->Matieres = array("1" => $Maths,"2" => $Physiques,"3" => $Biologié,"4" => $Informatique,"5" => $Anglais);
    }

    }

    class Matier {
        public $ID;
        public $Nom;
    
        function __construct($ID,$Nom) {
            $this->ID = $ID;
            $this->Nom = $Nom;
        }
        function get_name() {
            return $this->Nom;
        } 
    } 
    
    //Functions

    function get_object($x,$id){
        foreach($x as $value){
            if($value->ID == $id){
                return $value;
            }
        }
    }
    
    function Insert_Into_Db($conn,$object){
        $sql = "INSERT INTO `etudiant` (`ID_etudiant`, `Nom`, `Prénom`, `ID_classe`) VALUES (".$object->ID.", '".$object->Nom."', '".$object->Prenom."',1)";

        if (!mysqli_query($conn, $sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


        foreach(($object->Matieres) as $key => $value){
            $sql = "INSERT INTO `note` (`ID_etudiant`, `ID_matiere`, `Note`) VALUES (".$object->ID.", ".(int)$key.", ".(float)$value.")";

            if (!mysqli_query($conn, $sql)){
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        
    }

    function modify_Db($conn,$object){
        $sql = "UPDATE `etudiant` SET `Nom` = '".$object->Nom."' , `Prénom` = '".$object->Prenom."' WHERE `etudiant`.`ID_etudiant` = ".$object->ID;

        if (!mysqli_query($conn, $sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


        foreach(($object->Matieres) as $key => $value){
            $sql = "UPDATE `note` SET `Note` = '".(int)$value."' WHERE `note`.`ID_etudiant` = ".$object->ID." AND `note`.`ID_matiere` = ".(int)$key;

            if (!mysqli_query($conn, $sql)){
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        
    }
    
    function select_students_ids($conn){
        $sql = "SELECT ID_etudiant as IDD FROM `etudiant`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['IDD'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }

    function select_Matiére_ids($conn){
        $sql = "SELECT ID as IDD FROM `matiere`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['IDD'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }

    function select_Classe_ids($conn){
        $sql = "SELECT ID as IDD FROM `classe`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['IDD'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }


    function tache4($conn,$ID){
        $sql = "SELECT  Nom, Prénom, AVG(Note) as Moyenne
        FROM etudiant
        INNER JOIN note ON
        etudiant.ID_etudiant= note.ID_etudiant
        WHERE etudiant.ID_etudiant = ".$ID;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['Nom'];
             $array[] = $row['Prénom'];
             $array[] = $row['Moyenne'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }
    
    function tache5($conn,$mat,$classe){
        $sql = "SELECT classe.Nom as nomClasse,matiere.Nom as nomMatiere,AVG(Note)as Moyene_classe, etudiant.ID_classe as classe FROM note INNER JOIN matiere ON note.ID_matiere = matiere.ID INNER JOIN etudiant ON etudiant.ID_etudiant= note.ID_etudiant
        INNER JOIN classe ON etudiant.ID_classe = classe.ID WHERE etudiant.ID_classe = ".$classe." AND matiere.ID = ".$mat;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['nomClasse'];
             $array[] = $row['nomMatiere'];
             $array[] = $row['Moyene_classe'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }
    
    function tache6($conn,$id){
        $sql = "SELECT classe.Nom as nomClasse,AVG(Note)as Moyene_classe FROM note INNER JOIN matiere ON note.ID_matiere = matiere.ID INNER JOIN etudiant ON etudiant.ID_etudiant= note.ID_etudiant
        INNER JOIN classe ON classe.ID = etudiant.ID_classe WHERE etudiant.ID_classe = ".$id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['nomClasse'];
             $array[] = $row['Moyene_classe'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }
    
    function tache8($conn,$mat){
        $sql = "SELECT etudiant.ID_etudiant, etudiant.Nom, matiere.ID, matiere.Nom as nomMat, MIN(note)
        FROM  etudiant
        INNER JOIN note ON etudiant.ID_etudiant= note.ID_etudiant INNER JOIN matiere ON matiere.ID = note.ID_matiere
        WHERE note.ID_matiere =".$mat;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $array1[] = $row['ID_etudiant'];
            $array1[] = $row['Nom'];
            $array1[] = $row['ID'];
            $array1[] = $row['nomMat'];
            $array1[] = $row['MIN(note)'];
        }
        }
        
        $sql = "SELECT etudiant.ID_etudiant, etudiant.Nom, matiere.ID, matiere.Nom as nomMat, MAX(note)
        FROM  etudiant
        INNER JOIN note ON etudiant.ID_etudiant= note.ID_etudiant INNER JOIN matiere ON matiere.ID = note.ID_matiere
        WHERE note.ID_matiere =".$mat;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array2[] = $row['ID_etudiant'];
             $array2[] = $row['Nom'];
             $array2[] = $row['ID'];
             $array2[] = $row['nomMat'];
             $array2[] = $row['MAX(note)'];
        }
        }

        return array($array1,$array2);
    }
    
    function tache9($conn,$mat,$classe){
        $sql = "SELECT etudiant.ID_etudiant, etudiant.Nom, matiere.ID, matiere.Nom,etudiant.ID_classe,Note
        FROM  etudiant
        INNER JOIN note ON etudiant.ID_etudiant= note.ID_etudiant INNER JOIN matiere ON matiere.ID = note.ID_matiere
        WHERE note.ID_matiere = ".$mat."  AND etudiant.ID_classe = ".$classe."
        ORDER BY Note";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
             $array[] = $row['ID_etudiant'];
             $array[] = $row['Nom'];
             $array[] = $row['ID'];
             $array[] = $row['nomMat'];
             $array[] = $row['ID_classe'];
             $array[] = $row['Note'];
        }
        } else {
            echo "0 results";
        }
        return $array;
    }
    
    
    
    
    
    
    
    
    
    
    
    ?>