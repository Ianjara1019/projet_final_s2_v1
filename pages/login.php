<?php
session_start();
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if (!empty($error)) {
            echo "<p style='color: red;'>$error</p>";
        } ?>

        <form action="verify_login.php" method="post">
            <input type="email" name="email" placeholder="Entrer Email" required>
            <input type="password" name="mdp" placeholder="Entrer Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>

        <br>
        <a class="btn-secondary" href="../index.php">📝 S'inscrire</a>
    </div>
</body>

</html>