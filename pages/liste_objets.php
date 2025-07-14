<?php 
    include('../inc/function.php');

    // Ensure the database connection is established
    $db = dbconnect();

    if (!$db) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Fetch the list of objects
    $lo = liste_objet();

    // Fetch categories with error handling
    $categorie_query = "SELECT * FROM categorie_object";
    $categorie = mysqli_query($db, $categorie_query);

    if (!$categorie) {
        die("Error fetching categories: " . mysqli_error($db));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des objets</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <!-- Dropdown for categories -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Toutes catégories
            </button>
            <ul class="dropdown-menu">
                <?php while ($cat = mysqli_fetch_assoc($categorie)) { ?>
                    <li>
                        <a class="dropdown-item" href="traitement_filtre.php?id_cat=<?php echo htmlspecialchars($cat['id_categorie']); ?>">
                            <?php echo htmlspecialchars($cat['nom_categorie']); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <h2 class="mb-4">Liste des objets</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($lo as $objet) { ?>
            <div class="col">
                <div class="card h-100">
                <!-- <img src="<?php echo htmlspecialchars($objet['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($objet['nom_objet']); ?>"> -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($objet['nom_object']); ?></h5>
                </div>
                <div class="card-footer">
                    <?php if($objet['date_retour'] != null) {?>
                        <p><strong>Date de retour: </strong><?php echo $objet['date_retour']?></p>    
                    <?php } else {?>
                        <p><strong>Disponible</strong></p>    
                    <?php }?>
                </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>