<?php
session_start();
include('../inc/function.php');
mysqli_set_charset(dbconnect(), 'utf8');

if (isset($_GET['nom'], $_GET['email'], $_GET['mdp'], $_GET['date_naissance'], $_GET['genre'], $_GET['ville'])) {
    $nom = $_GET['nom'];
    $email = $_GET['email'];
    $mdp = $_GET['mdp'];
    $naissance = $_GET['date_naissance'];
    $genre = $_GET['genre'];
    $ville = $_GET['ville'];

    $insert = insert($nom, $email, $mdp, $naissance, $genre, $ville);

    if ($insert) {
        header('location: liste_objets.php');
    } else {
        echo "Erreur lors de l'inscription.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>
