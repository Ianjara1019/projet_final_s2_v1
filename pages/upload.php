<?php
session_start();
include('../inc/function.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$id_object = isset($_GET['id_object']) ? intval($_GET['id_object']) : 0;

// Vérifier que l'objet existe et appartient à l'utilisateur
if ($id_object > 0) {
  $conn = dbconnect();
  $query = "SELECT id_membre FROM objet WHERE id_object = $id_object";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $objet = mysqli_fetch_assoc($result);

    // if (!$objet || $objet['id_membre'] !== $_SESSION['user_id']) {
    //   header('Location: liste_objets.php?error=Accès non autorisé');
    //   exit();
    // }
  } else {
    header('Location: liste_objets.php?error=Erreur de requête');
    exit();
  }
} else {
  header('Location: liste_objets.php?error=Objet invalide');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Upload d'image</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
  .upload-container {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  .btn-upload {
    background-color: #0d6efd;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  </style>
</head>
<body class="upload">
  <div class="container">
  <div class="upload-container">
    <h2>Ajouter une image à l'objet</h2>
    
    <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Image ajoutée avec succès!</div>
    <?php endif; ?>

    <form action="traitement-upload.php?id_object=<?php echo $id_object; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_object" value="<?php echo $id_object; ?>">
    <div class="mb-3">
      <label for="fichier" class="form-label">Sélectionner une image</label>
      <input class="form-control" type="file" id="fichier" name="fichier" accept="image/*" required>
      <div class="form-text">Formats acceptés: JPEG, PNG (max 10Mo)</div>
    </div>
    <button type="submit" class="btn-upload">Ajouter</button>
    </form>
    <div class="mt-3">
    <a href="liste_objets.php" class="text-decoration-none">← Retour à la liste</a>
    </div>
  </div>
  </div>
</body>
</html>