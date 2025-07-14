<?php 
    include('../inc/function.php');

    $db = dbconnect(); 

    $lo = liste_objet();

    $categorie = mysqli_query($db, "SELECT * FROM categorie_object");
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
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="upload.php">Upload</a>
                </li>
                </ul>
                <a href="logout.php" class="btn btn-outline-danger">Deconnexion</a>
            </div>
        </div>
        </nav>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Toutes catégories
            </button>
            <ul class="dropdown-menu">
                <li> 
                    <a class="dropdown-item" href="liste_objets.php">Toutes catégories</a>
                </li>
                <?php while ($cat = mysqli_fetch_assoc($categorie)) { ?>
                    <li>
                        <a class="dropdown-item" href="Filtres.php?id_cat=<?php echo ($cat['id_categorie']); ?>">
                            <?php echo ($cat['nom_categorie']); ?>
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
                <!-- <img src="<?php echo ($objet['image_url']); ?>" class="card-img-top" alt="<?php echo ($objet['nom_objet']); ?>"> -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo ($objet['nom_object']); ?></h5>
                </div>
                <div class="card-footer">
                    <?php if($objet['date_retour'] != null) {?>
                        <p><strong>Date de retour: </strong><?php echo $objet['date_retour']?></p>    
                    <?php } else {?>
                        <p><strong>Disponible</strong></p>    
                    <?php }?>
                    <a href="upload.php?id_object=<?php echo $objet['id_object']?>">Ajouter image</a>
                </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>