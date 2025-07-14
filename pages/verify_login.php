<?php
session_start();
include('../inc/function.php');
mysqli_set_charset(dbconnect(), 'utf8');

if (isset($_POST['email'], $_POST['mdp'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $conn = dbconnect();
    $email = mysqli_real_escape_string($conn, $email);
    $mdp = mysqli_real_escape_string($conn, $mdp);
    $sql = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$mdp'";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id_membre'];
        $_SESSION['nom'] = $user['nom'];
        header("Location: liste_objets.php");
    } else {
        header("Location: login.php?error=Email ou mot de passe incorrect");
    }
} else {
    header("Location: login.php?error=Veuillez remplir tous les champs");
    exit();
}
?>
