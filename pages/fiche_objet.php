<?php
include('../inc/function.php');

$db = dbconnect();
$id_object = isset($_GET['id_object']) ? intval($_GET['id_object']) : 0;

if ($id_object) {
    $query = "SELECT * FROM objet WHERE id_object = $id_object";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $objet = mysqli_fetch_assoc($result);
        $images_query = "SELECT * FROM images WHERE id_object = $id_object";
        $images_result = mysqli_query($db, $images_query);
        $images = $images_result ? mysqli_fetch_all($images_result, MYSQLI_ASSOC) : [];
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
    <div class="container">
        <h1><?php echo htmlspecialchars($objet['nom_object']); ?></h1>
        <p><strong>Disponibilité :</strong> 
            <?php 
            $query_emprunt = "SELECT * FROM emprunt WHERE id_object = $id_object AND date_retour IS NULL";
            $emprunt_result = mysqli_query($db, $query_emprunt);
            echo ($emprunt_result && mysqli_num_rows($emprunt_result) > 0) ? 'Non disponible' : 'Disponible'; 
            ?>
        </p>
        
        <?php if (!empty($images)): ?>
            <h3>Images</h3>
            <div class="row">
                <?php foreach ($images as $image): ?>
                    <div class="col-md-4">
                        <img src="../assets/uploads/<?php echo htmlspecialchars($image['nom_image']); ?>" class="img-fluid" alt="Image de l'objet">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
