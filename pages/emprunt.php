<?php
    $id_object = $_GET['id_object'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitement_emprunt.php" method="get">
        <input type="hidden" name="id_object" value="<?php echo $id_object?>">
        <input type="number" name="duree" placeholder="Duree d'emprunt">
        <input type="submit" value="Valider">
    </form>
</body>
</html>