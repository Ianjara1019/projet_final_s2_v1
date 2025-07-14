<?php
include('../inc/function.php');

$db = dbconnect();
$id_object = $_GET['id_object'];

if ($id_object) {
    $query = "SELECT * FROM objects WHERE id_object = $id_object";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $objet = mysqli_fetch_assoc($result);
        $images = mysqli_query($db, "SELECT * FROM images WHERE id_object = $id_object");
    } else {
        die("Objet introuvable.");
    }
} else {
    die("Objet introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de l'objet</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1><?php echo ($objet['nom_object']) ?></h1>
        <p><?php echo ($objet['']) ?></p>
        <p><strong>Disponibilité :</strong> <?php echo $objet['date_retour'] ? 'Non disponible' : 'Disponible' ?></p>

        <h3>Images</h3>
        <div class="row">
            <?php while ($image = mysqli_fetch_assoc($images)): ?>
                <div class="col-md-4">
                    <img src="../assets/uploads/<?php echo ($image['nom_image']) ?>" class="img-fluid">
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>