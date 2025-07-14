<?php
function dbconnect() {
    static $connect = null;
    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'root', '', 'objet');
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

function getIDUser($user) {
    $conn = dbconnect();
    $requete_query = mysqli_query($conn, "SELECT id_membre FROM membre WHERE nom = '$user'");
    $result = mysqli_fetch_assoc($requete_query);

    return $result['id_membre'];
}

function insertimage($id_object, $newName) {
    $requete = "INSERT INTO  images_object(id_object, nom_image) values ('$id_object', '$newName')";

    return mysqli_query(dbconnect(), $requete);
}

?>
