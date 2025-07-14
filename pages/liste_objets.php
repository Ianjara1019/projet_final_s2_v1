<?php 
include('../inc/function.php');

$db = dbconnect();
$lo = liste_objet();
$categorie = mysqli_query($db, "SELECT * FROM categorie_object");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des objets</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Objets à partager</a>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-outline-danger">Déconnexion</a>
                </div>
            </div>
        </nav>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Catégories
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="liste_objets.php">Toutes catégories</a></li>
                        <?php while ($cat = mysqli_fetch_assoc($categorie)): ?>
                            <li><a class="dropdown-item" href="Filtres.php?id_cat=<?= $cat['id_categorie'] ?>">
                                <?php echo ($cat['nom_categorie']) ?>
                            </a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($objet = mysqli_fetch_assoc($lo)): ?>
                <?php 
                $image = mysqli_fetch_assoc(get_first_image($objet['id_object']));
                $disponible = $objet['date_retour'] ? 'Non disponible' : 'Disponible';
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <?php if ($image): ?>
                            <img src="../assets/uploads/<?php echo ($image['nom_image']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                            <a href="fiche_objet.php?id_object=<?php echo ($objet['id_object']) ?>">
                                <?php echo ($objet['nom_object']) ?>
                            </a>
                            </h5>
                            <p class="card-text <?= $objet['date_retour'] ? 'text-danger' : 'text-success' ?>">
                                <?= $disponible ?>
                            </p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="upload.php?id_object=<?php echo $objet['id_object'] ?>" class="btn btn-sm btn-outline-primary">
                                Ajouter image
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>