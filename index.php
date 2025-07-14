<?php
session_start();
include('./inc/function.php');
mysqli_set_charset(dbconnect(), 'utf8');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="pages/traitement.php" method="get">
            <input type="text" name="nom" placeholder="Entrer Nom" >
            <input type="email" name="email" placeholder="Entrer Email" >
            <input type="password" name="mdp" placeholder="Entrer Mot de passe" >
            <input type="date" name="date_naissance" >
            <input type="text" name="genre">
            <input type="text" name="ville">
            <input type="submit" value="S'inscrire">
        </form>

        <br>
        <a class="btn-secondary" href="pages/login.php">Se connecter</a>
    </div>
</body>

</html>