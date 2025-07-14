<?php 
include('../inc/function.php');
$lo = liste_objet();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-4">
        <h2 class="mb-4">Liste des objects</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($liste_objet = mysqli_fetch_assoc($lo)) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $liste_objet['nom_object'] ?>
                            </h5>
                            <p><strong>DATE DE RETOUR: <?php echo $liste_objet['date_retour'] ?></strong></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>