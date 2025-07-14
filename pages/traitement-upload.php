<?php
    session_start();
    include('../inc/function.php');
    $conn = dbconnect();
    $id_objet = $_GET['id_object'];

    $uploadDir =__DIR__.'/../assets/publication/';
    $maxSize = 10 * 1024 * 1024; // 10 Mo
    $allowedMimeTypes = array('video/mp4' , 'image/jpeg', 'image/png');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier'])) {
        $file = $_FILES['fichier'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            die('Erreur lors de l’upload : ' . $file['error']);
        }

        if ($file['size'] > $maxSize) {
            // die('Le fichier est trop volumineux.');
            header('Location: upload.php?error = Le fichier est trop volumineux');
        }

        // Vérifie le type MIME avec `finfo`
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMimeTypes)) {
            // die('Type de fichier non autorisé : ' . $mime);
            header('Location: upload.php?error = Type de fichier non autorisé : . $mime');
        }

        // renommer le fichier
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;

        // Déplace le fichier
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
            echo "Fichier uploadé avec succès : ". $newName;
            $id_user = getIDUser($email);
            $insertimage = insertimage($id_objet,$newName);
            header("location: upload.php?success = Video uploadé avec succès");
        } else {
            echo "Échec du déplacement du fichier.";
        }
    } else {
            ('Location: upload?error=Aucun fichier reçu.');
    }
?>