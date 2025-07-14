<?php
  $id_object = $_GET['id_object'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>object</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="upload">

  <div class="upload-container">
    <h2>Nouvelle publication</h2>
    <form action="traitement-upload.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
      </div>
      <input type="hidden" value="<?php echo $id_object; ?>">
      <div class="form-group">
        <label for="fichier">Image</label>
        <input type="file" id="fichier" name="fichier" accept="image/*,video/*" required>
      </div>
      <button type="submit" class="btn-upload">Publier</button>
    </form>
    <div class="back-link">
      <a href="liste_objtes.php?">⬅ Retour </a>
    </div>
  </div>

</body>
</html>