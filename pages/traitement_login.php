<?php
session_start();
include('../inc/function.php');

$conn = dbconnect();
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

if (isset($_POST['pseudo'])) {
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $user = $_SESSION['pseudo'];

    $requete = "SELECT nom FROM tiktox_user WHERE nom = '$user'";
    $result = mysqli_query($conn, $requete);

    if (!$result) {
        die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        header('Location: accueil.php');
        exit();
    } else {
        $insertion = "INSERT INTO tiktox_user(nom) VALUES('$user')";
        if (mysqli_query($conn, $insertion)) {
            header('Location: accueil.php');
            exit();
        } else {
            die("Erreur lors de l'insertion : " . mysqli_error($conn));
        }
    }
} else {
    die("Pseudo non fourni.");
}
?>