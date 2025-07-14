<?php
function dbconnect() {
    static $connect = null;
    if ($connect === null) {
        $connect = mysqli_connect('localhost', '172.60.0.11', 'MdrYaEQX', 'db_s2_ETU004011');
        if (!$connect) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }
    }
    return $connect;
}
 
function insert($nom, $email, $mdp, $naissance, $genre, $ville) {
    $conn = dbconnect();
    $sql = "INSERT INTO membre (nom, email, mdp, date_naissance, genre, ville) VALUES ('$nom', '$email', '$mdp', '$naissance', '$genre', '$ville' )";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Erreur d'insertion : " . mysqli_error($conn);
        return false;
    }
}

function liste_objet(){
    return $sql = mysqli_query(dbconnect(),"SELECT * from v_liste_objet"); 
}

function filtre_categorie($id_categorie){
    return $sql = mysqli_query(dbconnect(),"SELECT * from v_liste_objet where id_categorie = $id_categorie ");
}

?>
