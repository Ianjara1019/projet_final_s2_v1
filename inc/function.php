<?php
function dbconnect() {
    $connect = mysqli_connect('172.60.0.11', 'ETU004011', 'MdrYaEQX', 'db_s2_ETU004011');
    if (!$connect) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }
    mysqli_set_charset($connect, 'utf8');
    return $connect;
}

function insert($nom, $email, $mdp, $naissance, $genre, $ville) {
    $conn = dbconnect();
    $sql = "INSERT INTO membre (nom, email, mdp, date_naissance, genre, ville) 
            VALUES ('$nom', '$email', '$mdp', '$naissance', '$genre', '$ville')";
    
    return mysqli_query($conn, $sql);
}

function liste_objet() {
    return mysqli_query(dbconnect(), "SELECT * FROM v_liste_objet");
}

function filtre_categorie($id_categorie) {
    $id_categorie = intval($id_categorie);
    return mysqli_query(dbconnect(), "SELECT * FROM v_liste_objet WHERE id_categorie = $id_categorie");
}

function insertimage($id_object, $newName) {
    $conn = dbconnect();
    return mysqli_query($conn, "INSERT INTO images_object (id_object, nom_image) VALUES ($id_object, '$newName')");
}

function get_first_image($id_object) {
    $id_object = intval($id_object);
    return mysqli_query(dbconnect(), "SELECT nom_image FROM images_object WHERE id_object = $id_object LIMIT 1");
}

function insert_emprunt($id_user, $id_object,$date_emprunt, $date_retour) {
    return mysqli_query(dbconnect(),
    "UPDATE emprunt SET 
        id_membre = $id_user
        date_emprunt = '$date_emprunt',
        date_retour = '$date_retour'
    WHERE id_object = $id_object");
}
?>